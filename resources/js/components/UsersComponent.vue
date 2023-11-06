<template>
  <div class="container">
    <div class="row justify-content-center">
      <div>
        <!-- Contenido de la página -->
        <div>
          <div class="col-md-12">
            <div class="card border-dark mb-3">
              <div class="card-header">Listado de usuarios</div>

              <div class="card-body">
                <div>
                  <!-- <button @click="exportToCSV" class="btn btn-primary mb-3">Descargar CSV</button> -->
                </div>
                <div>
                  <h1>Usuarios</h1>
 
 
                    <DataTable
                          
                         :options="{language:{
                            decimal:'',
                            emptyTable:'No hay información',
                            info:'Mostrando _START_ a _END_ de _TOTAL_ Entradas',
                            infoEmpty:'Mostrando 0 to 0 of 0 Entradas',
                            infoFiltered:'(Filtrado de _MAX_ total entradas)',
                            infoPostFix:'',
                            thousands:',',
                            lengthMenu:'Mostrar _MENU_ Entradas',
                            loadingRecords:'Cargando...',
                            processing:'Procesando...',
                            search:'Buscar:',
                            zeroRecords:'Sin resultados encontrados',
                            paginate:{
                                first:'Primero',
                                last:'Ultimo',
                                next:'Siguiente',
                                previous:'Anterior'
                            }
                        }
                      }"
                          class="table table-hover table-striped" width="100%">
                          <thead>
                              <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Correo</th>
                                <!-- <th>Número empleado</th> -->
                                <th>Acciones</th>



                              </tr>
                          </thead>
                          <tbody>
                              <tr v-for="user in users" :key="user.id">
                                <td>{{ user.id }}</td>
                                <td>{{ user.name }}</td>
                                <td>{{ user.email }}</td>
                                <!-- <td>{{ user.employee_number }}</td> -->
                                <td>
                                  <button @click="editarUsuario(user)" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">Editar</button>
                                  <button @click="openConfirmDeleteModal(user.id)" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#myModal2">Eliminar</button>

                                </td>

                        </tr>
                          </tbody>
                      </DataTable>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

   <!-- Modal de Edición -->
<div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
  <div class="modal-dialog">
    <div class="modal-content border-dark" style="box-shadow: 10px 5px 5px black;">
      <div class="modal-header border-dark">
        <h5 class="modal-title" id="exampleModalLabel">Editar Usuario</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- Formulario de Edición -->
        <form @submit.prevent="updateUser">
      
          <div class="mb-1">
            <label for="name" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="name" v-model="userToEdit.name">
          </div>
          <div class="mb-1">
            <label for="email" class="form-label">Correo</label>
            <input type="email" class="form-control" id="email" v-model="userToEdit.email">
          </div>
          <div class="mb-1">
            <label for="employeeNumber" class="form-label">Número de Empleado</label>
            <input type="text" class="form-control" id="employeeNumber" v-model="userToEdit.employee_number_id">
          </div>
          <div class="mb-1">
          <label for="password" class="form-label">Contraseña</label>
          <input type="password" class="form-control" id="password" v-model="userToEdit.password">
        </div>
        <div class="mb-1">
          <label for="confirmPassword" class="form-label">Confirmar Contraseña</label>
          <input type="password" class="form-control" id="confirmPassword" v-model="userToEdit.confirmPassword">
        </div>
          <button type="submit" class="btn btn-primary mt-3">Actualizar</button>
        </form>
      </div>
    </div>
  </div>
</div>


<!-- Modal de Confirmación de Eliminación -->
<div class="modal fade" id="myModal2" tabindex="-1" aria-labelledby="exampleModalLabel2" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
  <div class="modal-dialog">
    <div class="modal-content border-dark" style="box-shadow: 10px 5px 5px black;">
      <div class="modal-header border-dark">
        <h5 class="modal-title" id="exampleModalLabel">Eliminar Usuario</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- Formulario de Edición -->
        <form @submit.prevent="updateUser">
         <p>¿Estás seguro de que deseas eliminar a este usuario?</p>
        
              <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
            <button type="button" class="btn btn-danger" @click="deleteUser">Eliminar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

  </div>
</template>

<script>
import { saveAs } from "file-saver";
import DataTable from "datatables.net-vue3";
import DataTablesCore from "datatables.net-bs5";

DataTable.use(DataTablesCore);

export default {
  props: ['users'],
  components: {
    DataTable,
  },
  data() {
    return {
      usersLocal: [],
      userToDelete: null,
      userToEdit: {
        id: null,
        name: '',
        email: '',
        employee_number_id: '',
        password: '',
        confirmPassword: '',

      },
    };
  },
  mounted() {
    this.usersLocal = this.users;
    console.log(this.usersLocal)
  },
  methods: {
    // ... (otras funciones)

    openConfirmDeleteModal(userId) {
      this.userToDelete = userId; 
     
    },
    deleteUser() {
      if (this.userToDelete) {
        console.log('Eliminar usuario con ID:', this.userToDelete);
       
      }
      
    },
    editarUsuario(user) {
      let employeeNumber = user.employee_number;
      let employeeNumberId = employeeNumber.id;
      let employeeNumberNumber = employeeNumber.number;
      let employeeNumberUserId = employeeNumber.user_id;
      console.log(employeeNumberNumber,employeeNumberId);

      this.userToEdit = { ...user }; 
      this.userToEdit.employee_number_id = employeeNumberNumber;
    },
    updateUser() {
      console.log('Datos actualizados:', this.userToEdit);
      if (this.userToEdit.password !== this.userToEdit.confirmPassword) {
        alert('Las contraseñas no coinciden');
        return;
      }

    const userId = this.userToEdit.id; 
    const userData = {
      name: this.userToEdit.name,
      email: this.userToEdit.email,
      employee_number_id: this.userToEdit.employee_number_id,
      password:this.userToEdit.password,
      confirmPassword:this.userToEdit.confirmPassword
    };

    axios
      .put(`/api/users/${userId}`, userData)
      .then(response => {
        console.log('Usuario actualizado:', response.data);
      })
      .catch(error => {

        console.error('Error al actualizar usuario:', error);
      });

    },
  },
};
</script>

<style>
@import 'bootstrap';
@import 'datatables.net-bs5';
</style>
