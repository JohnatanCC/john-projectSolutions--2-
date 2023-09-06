@props(['status'])

@if ($status)
    <div id="alertMessage" {{ $attributes->merge(['class' => 'fade-out font-medium text-sm text-black-600 dark:text-black-400']) }}>
        {{ $status }}
    </div>
@endif

<script>
    // Espera 2 segundos e, em seguida, remove o alerta
    setTimeout(function() {
        var alertMessage = document.getElementById('alertMessage');
        if (alertMessage) {
            alertMessage.remove();
        }
    }, 2000); // 2000 milissegundos = 2 segundos
</script>
