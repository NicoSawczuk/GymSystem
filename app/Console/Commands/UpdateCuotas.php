<?php

namespace App\Console\Commands;

use App\Cliente;
use App\Cuota;
use App\Estado;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpKernel\Client;

class UpdateCuotas extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cuotas:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Este comando es utilizado para actualizar el estado de las cuotas de los clientes cuando estas vencen';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //Obtenemos la fecha de hoy
        $fecha = date ( 'Y-m-d');
        //Le restamos un mes
        $nuevafecha = strtotime ( '-1 month' , strtotime ( $fecha ) ) ;
        $nuevafecha = date ( 'Y-m-d' , $nuevafecha );

        if (Cuota::where('fecha_pago', $nuevafecha)->exists()){
            $cuotas = Cuota::where(['fecha_pago'=> $nuevafecha, 'vencido' => 0])->get();
            foreach ($cuotas as $cuota){
                $cliente = Cliente::where('id', $cuota->cliente_id)->first();

                $cuota->vencido = 1;
                $cliente->estado_id = Estado::where('orden', 4)->value('id');
                $cuota->monto_deuda += $cliente->especialidad->monto;

                $cliente->save();
                $cuota->save();
            }
        }


    }
}
