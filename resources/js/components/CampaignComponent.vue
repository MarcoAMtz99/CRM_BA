<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card border-dark mb-3">
                    <div class="card-header">Campañas</div>

                    <div class="card-body">
                       <div>
                        <button @click="downloadCSV" class="btn btn-primary mb-3">Descargar CSV</button>
                        <table class="table table-striped table-bordered">
                          <thead class="thead-dark">
                            <tr>
                              <th>ID</th>
                              <th>Tipo de Campaña</th>
                              <th>Acción</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr v-for="(item, index) in campanias" :key="index">
                              <td>{{ item.id }}</td>
                              <td>{{ item.tipoCampania == 1 ? "inbount": "outbount" }}</td>
                              <td>
                                <a :href="'/campañas/detalle/' + item.id" class="btn btn-info">Ver</a>
                              </td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { saveAs } from "file-saver";
  
    export default {
      props: {
        id: Number,
      },
        data() {
        return {
          campanias: [],
          idUrl:"",
        };
      },
        mounted() {
            // console.log('ID URL.',this.id);
            // this.idUrl  = this.id;
            this.consultarAPI();
        },
         methods: {
     async consultarAPI() {
          try {
            const idDespacho = 15; 
            const apiUrl = `https://www.gestioncobranzabaz.com.mx/GestionesCC/v2/consulta-campania?idDespacho=${idDespacho}`;

            const headers = {
              'Content-Type': 'application/json',
              'Authorization': 'Basic ' + btoa('JeYXUErLkDgWzA9Pp8c2uMOkSppDq9YafWQzXVkv6itpvVrGejXSf:kDF3NFAPwKyPU8JS+Q25nAb0Fn66/RrtlJ3kofnJ8VOcbiraA0nU6w'), 
              'x-api-key': 'SDRgX_Jv8vziBFIQHSCNcCIkc6pmJHlPcDUFl8lWajg=', 
            };

            const response = await axios.post(apiUrl, {}, { headers });
            this.campanias = response.data.resultado.campanias;
            console.log('Respuesta de la API:',  this.campanias);
          } catch (error) {
            
            console.error('Error en la solicitud:', error);
          }
            },
           viewAction(index) {
              // Implementa aquí la acción para ver los detalles del ítem
              console.log('Ver detalles de', this.tableData[index]);
            },
            exportToCSV() {
             try {
                const data = this.clientes;
                const csvContent = this.convertArrayToCSV(data);
                const blob = new Blob([csvContent], { type: "text/csv;charset=utf-8" });
                saveAs(blob, "clientes.csv");
              } catch (error) {
                console.error("Error al exportar datos a CSV:", error);
              }
            },
            convertArrayToCSV(data) {
              const header = Object.keys(data[0]).join(",");
              const rows = data.map(item => Object.values(item).join(","));
              return header + "\n" + rows.join("\n");
            },


      },
    }
</script>
