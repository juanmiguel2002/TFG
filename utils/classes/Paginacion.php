<?php

class Paginacion {
    
    private $total_registros;
    private $registros_por_pagina;
    private $total_paginas;
    private $pagina_actual;
    private $offset;
    private $paginas_a_mostrar;

    public function __construct($total_registros, $registros_por_pagina, $pagina_actual, $paginas_a_mostrar) {
        $this->total_registros = $total_registros;
        $this->registros_por_pagina = $registros_por_pagina;
        $this->pagina_actual = $pagina_actual;
        $this->paginas_a_mostrar = $paginas_a_mostrar;

        # Calculamos el número total de páginas
        $this->total_paginas = ceil($this->total_registros / $this->registros_por_pagina);

        # Para obtener las páginas dividimos el conteo entre los productos por página, y redondeamos hacia arriba
        $this->offset = ($this->pagina_actual - 1) * $this->registros_por_pagina;
    }
    
    # Métodos para obtener los valores de los atributos
    public function getTotalRegistros() {
        return $this->total_registros;
    }

    public function getRegistrosPorPagina() {
        return $this->registros_por_pagina;
    }

    public function getTotalPaginas() {
        return $this->total_paginas;
    }

    public function getPaginaActual() {
        return $this->pagina_actual;
    }

    public function getOffset() {
        return $this->offset;
    }

    public function getPaginasAMostrar() {
        return $this->paginas_a_mostrar;
    }
    
}
?>