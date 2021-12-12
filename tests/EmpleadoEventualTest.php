<?php
require_once "EmpleadoTest.php";
class EmpleadoEventualTest extends EmpleadoTest
{
	public function crearDefault($nombre = "Lihuen",$apellido = "Pastor",$dni = 23322332, $salario = "230000", $montos=array(7000,5000,3300,550))
	{
		$empleadoEventual = new \App\EmpleadoEventual($nombre, $apellido, $dni, $salario, $montos);
		return $empleadoEventual;
	}

    //Test calcular comisión
	public function testCalcularComision()
    {
        $empleadoEv= $this->crearDefault(); 
        $this->assertEquals(198.125, $empleadoEv->calcularComision()); 
    }

    //Test calcular Ingreso Total
    public function testFuncionaMetodoCalcularIngresoTotal()
    {
        $empleadoEv = $this->crearDefault();
        $this->assertEquals(230198.125, $empleadoEv->calcularIngresoTotal());
    }

    //Test monto invalido. Si el monto es negativo o 0 hay una excepción
    public function testMontoInvalido()
    {
        $this->expectException(\Exception::class);
        $empleadoEv = $this->crearDefault("Lihuen", "Pastor", 23322332, 230000, $array = array(15, 30, 60,-90)); //Creo el empleado con valores negativos
    }
} 