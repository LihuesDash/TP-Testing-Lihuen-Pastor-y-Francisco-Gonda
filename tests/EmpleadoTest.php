<?php
abstract class EmpleadoTest extends \PHPUnit\Framework\TestCase{
	
	//Con la funcion crear se crea un empleado en base a los parametros enviados
	public function crearDefault($nombre = "Lihuen", $apellido = "Pastor", $dni = 23322332, $salario = "230000")
	{
		$empleado = new \App\Empleado ($nombre, $apellido, $dni , $salario);
		return $empleado;
	}

	//Test para probar getNombreApellido
	public function testObtenerNombreApellido()
	{
		$empleado = $this-> crearDefault(); 
		$this->assertEquals("Lihuen Pastor", $empleado->getNombreApellido());
	}

	//test para probar getDni
	public function testFuncionaObtenerDni()
	{
		$empleado = $this-> crearDefault(); 
		$this->assertEquals(23322332, $empleado->getDni());
	}

	//Test para Probar getSalario
	public function testFuncionaObtenerSalario()
	{
		$empleado = $this-> crearDefault(); 
		$this->assertEquals("230000", $empleado->getSalario());
	} 

	//Realiza un test para comprobar que al empleado se le asigna un sector 
	public function testFuncionaSector()
	{
		$empleado = $this->crearDefault();
		$this->assertEquals("No especificado", $empleado->getSector());
		
		$empleado->setSector("Backend"); //Edito el sector de trabajo
		$this->assertEquals("Backend", $empleado->getSector());
	}

	//test Probar ToString
	public function testFuncionaToString()
	{
		$empleado = $this->crearDefault(); 
		//Transformo en sting la variable empleado.
		$this->assertEquals("Lihuen Pastor 23322332 230000", $empleado); 
		$this->assertEquals("Lihuen Pastor 23322332 230000", $empleado->__toString());
		$this->assertEquals("Lihuen Pastor 23322332 230000", $empleado . ""); 
		$this->assertEquals("Lihuen Pastor 23322332 230000", strval($empleado)); 
	}

	//Test exception nombre vacío usando un string vacio
	public function testNombreVacio()
	{
		$this->expectException(\Exception::class); //Aviso de que se espera una excepción
		$this-> crearDefault("", "Pastor", 23322332, "230000"); //Intento crear un empleado sin nombre 
	}

	//Test exception nombre vacío usando false como valor
	public function testNombreVacio2()
	{
		$this->expectException(\Exception::class); 
		$this-> crearDefault(false, "Pastor", 23322332, "230000"); //al intentar crear un empleado sin nombre el valor false es tomado como vacío.
	}

	//Test exception apellido vacío usando un string vacio
	public function testApellidoVacio()
	{
		$this->expectException(\Exception::class);
		$this-> crearDefault("Lihuen", "", 23322332, "230000"); //Intento crear un empleado sin apellido 
	}
	
	//Test exception apellido vacío usando false como valor
	public function testApellidoVacio2()
	{
		$this->expectException(\Exception::class); 
		$this-> crearDefault("Lihuen", false, 23322332, "230000"); //Al intentar crear un empleado sin apellido el valor false es tomado como vacío.
	}

	//Test exception dni vacío usando un string vacio
	public function testDNIVacio()
	{
		$this->expectException(\Exception::class); 
		$this-> crearDefault("Lihuen", "Pastor", "", "230000"); //Intento crear un empleado sin dni 
	}
	
	//Test exception dni vacío usando false como valor
	public function testDNIVacio2()
	{
		$this->expectException(\Exception::class); 
		$this-> crearDefault("Lihuen", "Pastor", null, "230000"); //Al intentar crear un empleado sin DNI el valor false es tomado como vacío. 
	}

	//Test exception dni vacío usando 0 como valor
	public function testDNIVacio3()
	{
		$this->expectException(\Exception::class); 
		$this-> crearDefault("Lihuen", "Pastor", 0, "230000"); //Al intentar crear un empleado sin DNI el valor 0 es tomado como vacío.
	}

	//Test exception salario vacío usando un string vacio
	public function testSalarioVacio()
	{
		$this->expectException(\Exception::class); 
		$this-> crearDefault("Lihuen", "Pastor", 23322332, ""); //Intento crear un empleado sin salario 
	}
	
	//Test exception salario vacío usando false como valor
	public function testSalarioVacio2()
	{
		$this->expectException(\Exception::class); 
		$this-> crearDefault("Lihuen", "Pastor", 23322332, false); //Al intentar crear un empleado sin salario el valor false es tomado como vacío.
	}

	//Test dni con valores no numericos ni convertibles 
	public function testDniValoresNoNumericos()
	{
		$this->expectException(\Exception::class);
		$this-> crearDefault("Lihuen", "Pastor", "R23322332", "230000"); //Agrego una letra al string numerico
	}

	//Test sector sin identificar
	public function testNoSeIdentificaSector()
	{
		$empleado = $this-> crearDefault("Lihuen","Pastor", 23322332, "230000");
		$this->assertEquals("No especificado", $empleado->getSector());
	}

}	
	