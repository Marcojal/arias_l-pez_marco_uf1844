<?php

// Creamos Clase abstracta Plantilla:

abstract class Plantilla {
 protected string $dni;
 protected string $nombre;
 protected string $apellidos;
 protected int $fechaAlta;


 function __construct (string $dni, string $nombre, string $apellidos, int $fechaAlta)
 {
  $this->dni = $dni;
  $this->nombre = $nombre;
  $this->apellidos = $apellidos;
  $this->fechaAlta = $fechaAlta;
 }
}


// Creamos Clase hija para empleados fijos:
class Fijo extends Plantilla {
 protected int $sueldoFijo;

 function __construct(string $dni, string $nombre, string $apellidos, int $fechaAlta)
 {
  parent::__construct($dni, $nombre, $apellidos, $fechaAlta);
  $this->sueldoFijo = 1200;
 }


 function setSueldoFijo ($sueldoFijo) {
  $this->sueldoFijo = $sueldoFijo;
 }

// Función para calcular el sueldo según la antigüedad:
 function calcularSueldo () {
  $antiguedad = date('Y') - $this->fechaAlta;
  $comision = 0;

  if ($antiguedad >= 2 && $antiguedad <= 7) {
   $comision = 0.15;
  } elseif ($antiguedad > 7) {
   $comision = 0.25;
  }

  $sueldoTotal = $this->sueldoFijo + ($this->sueldoFijo * $comision);
  return $sueldoTotal;
 }


 function __toString () {
  $antiguedad = date('Y') - $this->fechaAlta;
  return "FIJO <br>".
         "Nombre: " . " $this->nombre" . " $this->apellidos <br>" .
         "DNI: " .  "$this->dni <br>" .
         "Fecha de Ingreso: " . "$this->fechaAlta <br>" .
         "Salario Base: " . "$this->sueldoFijo <br>" . 
         "Antigüedad: " . "$antiguedad <br>" .
         "Sueldo: " . $this->calcularSueldo(). "<br>";
 }
}

// Creamos clase específica para empleados eventuales
class Eventual extends Plantilla {
 protected int $encargos;
 protected int $multilenguaje;

 public function __construct(string $dni, string $nombre, string $apellidos, int $fechaAlta)
 {
  parent::__construct($dni, $nombre, $apellidos, $fechaAlta);
  $this->encargos = 0;
  $this->multilenguaje = false;
 }

 // Setters y getters por si acaso:
 function getEncargos () { return $this->encargos; }

 function setEncargos ($encargos) { $this->encargos = $encargos; }

 function getMultilenguaje () { return $this->multilenguaje; }

 function setMultilenguaje ($multilenguaje) { $this->multilenguaje = $multilenguaje; }


 // Creamos función para calcular el sueldo dependiendo del número de encargos, y si son multilenguaje:
 function calcularSueldo () {
  $sueldoTotal = $this->encargos * 800;
  if ($this->multilenguaje) {
   $sueldoTotal += 300;
  }
  return $sueldoTotal;
 }


 function __toString () {
  $tipoEncargo = $this->multilenguaje ? 'Multilenguaje' : 'Normal';
  $sueldoTotal = $this->calcularSueldo ();

  return "EVENTUAL <br>".
  "Nombre: " . " $this->nombre" . " $this->apellidos <br>" .
  "DNI: " .  "$this->dni <br>" .
  "Fecha de Ingreso: " . "$this->fechaAlta <br>" .
  "Sueldo: " . $this->calcularSueldo(). "<br>";
}

}


// Ejemplos: 
// Empleado fijo:
$fijo = new Fijo ("39764874R", "Calimero", "Chórrez", 2010);
$fijo2 = new Fijo ("38736847H", "Elba", "Surero", 2018 );
echo $fijo, $fijo2;

// Empleado eventual:
$eventual = new Eventual("38976977P", "Yolande", "Plastas", 2022);
$eventual->setEncargos(3);
$eventual->setMultilenguaje(true);
echo $eventual;
