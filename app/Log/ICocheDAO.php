<?php
interface ICocheDAO {
    public function darAlta(Coche $coche);
    public function darBaja($matricula);
    public function modificarCoche($matricula, Coche $nuevoCoche);
    public function obtenerCoche($matricula);
    public function verTodos();
}
?>
