<?php
require_once 'EmpleadoTest.php';
	
class EmpleadoPermanenteTest extends EmpleadoTest{
    
    public function crearDefault($nombre="Lihuen", $apellido="Pastor", $dni=23322332, $salario=230000, $fechaIngreso=null){
        $fecha = new \DateTime();
        $empleadoPe = new \App\EmpleadoPermanente($nombre, $apellido, $dni, $salario, $fechaIngreso);
        return $empleadoPe;
    }

    //Test para CrearIngreso
    public function testCrearIngreso(){
        $fechaActual = new DateTime(); 
        $empleadoPe= $this->crearDefault(); 
        $this->assertEquals($fechaActual->format('Y-m-d'), $empleadoPe->getFechaIngreso()->format('Y-m-d'));
    }
    //Test calcularComision
    public function testCalcularComisionAntiguedad(){
        $ingreso = new DateTime(); 
        $ingreso->modify('-10 years'); // Modifico el ingreso en 10 años
        $empleadoPe= $this->crearDefault("Lihuen", "Pastor", 23322332, 230000, $ingreso); 
        $this->assertEquals("10%",$empleadoPe->calcularComision());
    }
    //Test calcularIngresoTotal
    public function testCalcularIngresoTotal(){
        $ingreso = new DateTime();
        $ingreso->modify('-10 years'); // Modifico el ingreso en 10 años
        $empleadoPe= $this->crearDefault("Lihuen", "Pastor", 23322332, 230000, $ingreso); 
        $this->assertEquals(253000,$empleadoPe->calcularIngresoTotal());
    }
    //Test calcularAntiguedad
    public function testAntiguedad(){
        $ingreso = new DateTime(); 
        $ingreso->modify('-10 years'); // Modifico el ingreso en 10 años
        $empleadoPe= $this->crearDefault("Francisco", "Gonda", 23322332, 230000, $ingreso);
        $this->assertEquals(10,$empleadoPe->calcularAntiguedad());
    }
    
    //Test demostrar que si no ingresa fecha el valor es el dia actual y la antiguedad es igual a 0
    public function testFechaSinProporcionar()
    {
        $empleadoPe = $this->crearDefault("Francisco", "Gonda", 23322332, 230000);
        $fecha = new DateTime(); 
        $this->assertEquals(date_format($fecha, 'y-m-d'), date_format($empleadoPe->getFechaIngreso(), 'y-m-d')); // si la fecha es nula la clase retorna la fecha de hoy ($fecha)
        $this->assertEquals(0, $empleadoPe->calcularAntiguedad()); 
    }

    //Tests excepción fecha de ingreso posterior a hoy
    public function testFechaPosterior(){
        $ingreso = new DateTime(); 
        $ingreso->modify('+10 years'); //le sumo 10 años a la fecha creada
        $this->expectException(\Exception::class); 
        $empleadoPe= $this->crearDefault("Francisco", "Gonda", 23322332, 230000, $ingreso); //tiro la excepcion al iniciar 
    }
    
}