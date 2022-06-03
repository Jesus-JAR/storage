<?php

namespace App\Http\Livewire;

use Barryvdh\DomPDF\Facade\Pdf;
use Livewire\Component;
use App\Models\Records;
use Livewire\WithPagination;
use App\Models\Bussines;
use Carbon\Carbon;
use RealRashid\SweetAlert\Facades\Alert;

class CheckIn extends Component
{
    use WithPagination;

    public $date;
    public $check_in;
    public $check_out = false;

    public $LastInsertId;
    public $hour_in;
    public $hour_out;
    public $created_at;
    public $record_id;
    public $valor;
    public $create_record;
    public $boleano = false;

    public $enter;
    public $exit;


    public $day;
    public $total;

    public $confirmingCheckInAdd = false;

    // variables protegidas
    protected $queryString = [
        'date' => ['except' => ''],
        'sortBy' => ['except' => 'id'],
        'sortAsc' => ['except' => true],
    ];

    /*
     *  Sort
     */
    public $sortBy = 'id';
    public $sortAsc = true;

    public function render()
    {
        $records = Records::where('user_id', auth()->user()->id)
            ->when($this->date, function ($query) {
                return $query->where(function ($query) {
                    $query->whereDate('created_at', '=', $this->date);
                });
            })
            ->orderBy($this->sortBy, $this->sortAsc ? 'ASC' : 'DESC');
        $query = $records->toSql();
        $records = $records->paginate(10);

        /*
         * show company
         */
        $companies = Bussines::where('id', '=', auth()->user()->getAttribute('cod_emp'))
            ->select('name')->get();


        return view('livewire.check-in', [
            'records' => $records,
            'query' => $query,
            'companies' => $companies
        ]);
    }


    public function updatingDate()
    {
        $this->resetPage();
    }

    public function sortBy($field)
    {
        if ($field == $this->sortBy) {
            $this->sortAsc = !$this->sortAsc;
        }
        $this->sortBy = $field;
    }

    public function confirmingCheckInAdd()
    {
        $this->confirmingCheckInAdd = true;
    }

    /*
     *  check in
     */
    public function check_in()
    {
        $message = '';
        if (Records::all()->where('user_id', '=', auth()->id())->isEmpty()){
            $message = 'esta vacio';
            $this->create_record = auth()->user()->records()
                ->create([
                    'hour_in' => now(),
                ]);
        }else{
            $message = 'esta lleno';
            $this->created_at = Records::all()
                ->where('user_id', '=', auth()->id())->last()->getAttribute('created_at');
            $this->day = Carbon::today();
            $this->boleano = $this->created_at->isSameDay($this->day);

            if (!($this->boleano)){
                $this->create_record = auth()->user()->records()
                    ->create([
                        'hour_in' => now(),
                    ]);
                $this->check_out = false;
            }
        }
    }

    public function check_out()
    {
        $this->LastInsertId = Records::all()->last()->getAttribute('id');
        config(['app.record_id' => $this->LastInsertId ]);
        $this->valor = config('app.record_id');


        $this->enter = Records::all()
            ->where('user_id', '=', auth()->id())->last()->getAttribute('hour_in');

        $this->exit = Records::all()
            ->where('user_id', '=', auth()->id())->last()->getAttribute('hour_out');

        if ($this->enter !== null and $this->exit === null){
            auth()->user()->records()
                ->where('id', '=', $this->valor )
                ->update([
                    'hour_out' => now()
                ]);
            $this->check_out = true;


            $entrada = Carbon::parse(Records::all()->last()->getAttribute('hour_in'));
            $salida = Carbon::parse(Records::all()->last()->getAttribute('hour_out'));

            $this->total = $entrada->diffForHumans( $salida,false, false, 2);

            // salida

            auth()->user()->records()
                ->where('id', '=', $this->valor )
                ->update([
                    'total' => $this->total
                ]);

        }

    }

    public function downloadPDF()
    {
        $records = Records::where('user_id', auth()->user()->id)->get();
        $pdf = PDF::loadView('pdf.pdf', ['records' => $records]);
        return $pdf->stream();
    }


}
