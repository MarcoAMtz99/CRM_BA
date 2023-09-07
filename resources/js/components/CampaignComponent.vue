<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Campaign</div>

                    <div class="card-body">
                       <div>
                        <!-- Botón para activar la solicitud -->
                        <button @click="consultarAPI" class="btn btn-primary">Consultar API</button>
                      </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component Consultar.')
        },
         methods: {
     async consultarAPI() {
      try {
        // URL del endpoint de la API
        const apiUrl = 'https://www.gestioncobranzabaz.com.mx/GestionesCC/v1/consulta-campania';

        // Datos de la solicitud POST
        const requestData = {
          idDespacho: 15, // Parámetro en la URL
        };

        // Encabezados de la solicitud
        const headers = {
          'Content-Type': 'application/json',
          'x-api-key': 'SDRgX_Jv8vziBFIQHSCNcCIkc6pmJHlPcDUFl8lWajg=',
        };

        // Realiza la solicitud POST
        const response = await axios.post(apiUrl, requestData, { headers });

        // Muestra la respuesta en console.log
        console.log('Respuesta de la API:', response.data);
      } catch (error) {
        // Maneja cualquier error que pueda ocurrir
        console.error('Error en la solicitud:', error);
      }
    },
  },
    }
</script>
