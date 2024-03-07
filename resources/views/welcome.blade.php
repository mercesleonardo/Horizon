@foreach ($media as $nota)
<?php
    $result = ($nota->notaParcial1 + $nota->notaParcial2 + $nota->notaParcial3) / 3;
?>
    {{$nota->nome}}
    {{$result}}
@endforeach

