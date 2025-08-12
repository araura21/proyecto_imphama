// usuarios.js - CRUD y paginación para usuarios

window.initUsuarios = function() {
  cargarEmpleadosYRoles();
  cargarUsuarios();
// Cargar empleados y roles en el formulario y asignar rol automáticamente
function cargarEmpleadosYRoles() {
  // Cargar empleados
  fetch('../controlador/empleadosController.php?action=listar')
    .then(r => r.json())
    .then(data => {
      if (data.success) {
        const select = document.getElementById('idEmpleado');
        select.innerHTML = '<option value="">Seleccione...</option>';
        data.empleados.forEach(emp => {
          select.innerHTML += `<option value="${emp.idEmpleado}" data-rol="${emp.rol ?? ''}" data-correo="${emp.correo ?? ''}">${emp.nombre} ${emp.apellido} (${emp.cedula})</option>`;
        });

        // Autocompletar usuario con correo del empleado seleccionado
        select.onchange = function() {
          const selected = select.options[select.selectedIndex];
          const correo = selected.getAttribute('data-correo') || '';
          document.getElementById('usuario').value = correo;
        };
      }
    });
  // Cargar roles y llenar el select de roles
  fetch('../controlador/rolesController.php?action=listar')
    .then(r => r.json())
    .then(data => {
      if (data.success) {
        window._rolesUsuarios = data.roles;
        const selectRol = document.getElementById('idRol');
        if (selectRol) {
          selectRol.innerHTML = '<option value="">Seleccione...</option>';
          data.roles.forEach(rol => {
            selectRol.innerHTML += `<option value="${rol.idRol}">${rol.idRol}</option>`;
          });
        }
      }
    });
  // Mostrar el nombre del rol seleccionado en el input readonly
  document.getElementById('idRol').addEventListener('change', function() {
    const idRol = this.value;
    const rol = (window._rolesUsuarios || []).find(r => r.idRol == idRol);
    document.getElementById('rolEmpleado').value = rol ? rol.nombre : '';
  });

  // Evento para actualizar el rol automáticamente
  // Si quieres que el nombre del rol se asigne automáticamente según el empleado, aquí puedes hacerlo
}

  // Mensaje
  let msg = document.getElementById('msg-usuarios');
  if (!msg) {
    msg = document.createElement('div');
    msg.id = 'msg-usuarios';
    msg.style.margin = '10px 0';
    msg.style.textAlign = 'center';
    document.querySelector('h2').insertAdjacentElement('afterend', msg);
  }

  // Validación en tiempo real de contraseña
  const passwordInput = document.getElementById('password');
  passwordInput.oninput = function() {
    const val = passwordInput.value;
    if (val.length !== 10) {
      passwordInput.setCustomValidity('La contraseña debe tener exactamente 10 caracteres.');
    } else if (!/[0-9]/.test(val)) {
      passwordInput.setCustomValidity('La contraseña debe contener al menos un número.');
    } else if (!/[!@#$%^&*()_+\-=[\]{};':"\\|,.<>/?]/.test(val)) {
      passwordInput.setCustomValidity('La contraseña debe contener al menos un caracter especial.');
    } else {
      passwordInput.setCustomValidity('');
    }
  };

  document.getElementById('formAgregarUsuario').addEventListener('submit', function(e) {
    e.preventDefault();
    const idEmpleado = document.getElementById('idEmpleado').value;
    const idRol = document.getElementById('idRol').value;
    const usuario = document.getElementById('usuario').value;
    const password = document.getElementById('password').value;
    const estado = document.getElementById('estado').value;
    // Validaciones
    if (usuario.length === 0 || usuario.length > 50) {
      msg.textContent = 'El usuario debe tener máximo 50 caracteres.';
      msg.style.color = 'red';
      return;
    }
    if (passwordInput.validationMessage) {
      msg.textContent = passwordInput.validationMessage;
      msg.style.color = 'red';
      passwordInput.reportValidity();
      return;
    }
    // Si pasa validaciones, enviar
    fetch('../controlador/usuarios/agregarUsuario.php', {
      method: 'POST',
      headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
      body: `idEmpleado=${encodeURIComponent(idEmpleado)}&idRol=${encodeURIComponent(idRol)}&usuario=${encodeURIComponent(usuario)}&password=${encodeURIComponent(password)}&estado=${encodeURIComponent(estado)}`
    })
    .then(r => r.json())
    .then(data => {
      msg.textContent = data.message;
      msg.style.color = data.success ? 'green' : 'red';
      if (data.success) {
        document.getElementById('formAgregarUsuario').reset();
        cargarUsuarios();
      }
    })
    .catch(() => {
      msg.textContent = 'Error de conexión con el servidor.';
      msg.style.color = 'red';
    });
  });
}

function cargarUsuarios() {
  fetch('../controlador/usuariosController.php?action=listar')
    .then(r => r.json())
    .then(data => {
      if (data.success) {
        // --- Paginación igual a roles/empleados ---
        let usuarios = data.usuarios;
        let pageSize = 3;
        let currentPage = 1;
        // Contenedor de paginación y selector
        const paginacionContainer = document.createElement('div');
        paginacionContainer.style.display = 'flex';
        paginacionContainer.style.justifyContent = 'space-between';
        paginacionContainer.style.alignItems = 'center';
        paginacionContainer.style.marginBottom = '12px';
        // Selector de cantidad
        const select = document.createElement('select');
        [3,5,7].forEach(n => {
          const opt = document.createElement('option');
          opt.value = n;
          opt.textContent = n + ' por página';
          select.appendChild(opt);
        });
        select.value = pageSize;
        select.style.marginRight = '16px';
        // Controles de página
        const controls = document.createElement('div');
        const btnPrev = document.createElement('button');
        btnPrev.textContent = 'Anterior';
        btnPrev.style.marginRight = '8px';
        const btnNext = document.createElement('button');
        btnNext.textContent = 'Siguiente';
        const pageInfo = document.createElement('span');
        pageInfo.style.margin = '0 10px';
        controls.appendChild(btnPrev);
        controls.appendChild(pageInfo);
        controls.appendChild(btnNext);

        // Modal edición y eliminar
  function abrirModalEditar(usuario) {
          // Cargar empleados y roles en selects del modal
          fetch('../controlador/empleadosController.php?action=listar')
            .then(r => r.json())
            .then(dataEmp => {
              const selEmp = document.getElementById('edit_idEmpleado');
              selEmp.innerHTML = '<option value="">Seleccione...</option>';
              let empActual = null;
              dataEmp.empleados.forEach(emp => {
                selEmp.innerHTML += `<option value=\"${emp.idEmpleado}\" data-correo=\"${emp.correo ?? ''}\">${emp.nombre} ${emp.apellido} (${emp.cedula})</option>`;
                if (emp.idEmpleado == usuario.idEmpleado) empActual = emp;
              });
              setTimeout(() => { 
                selEmp.value = usuario.idEmpleado;
                // Autocompletar usuario con correo del empleado seleccionado y bloquear edición
                const selected = selEmp.options[selEmp.selectedIndex];
                const correo = selected.getAttribute('data-correo') || '';
                const editUsuario = document.getElementById('edit_usuario');
                editUsuario.value = correo;
                editUsuario.readOnly = true;
                editUsuario.style.background = '#f4f4f4';
                editUsuario.style.color = '#333';
              }, 0);
              selEmp.onchange = function() {
                const selected = selEmp.options[selEmp.selectedIndex];
                const correo = selected.getAttribute('data-correo') || '';
                const editUsuario = document.getElementById('edit_usuario');
                editUsuario.value = correo;
                editUsuario.readOnly = true;
                editUsuario.style.background = '#f4f4f4';
                editUsuario.style.color = '#333';
              };
              // Mostrar info en cabecera usando los datos del usuario
              let info = '';
              if (usuario.nombreEmpleado && usuario.apellidoEmpleado && usuario.cedula) {
                info += `<b>${usuario.nombreEmpleado} ${usuario.apellidoEmpleado}</b> &nbsp; <span style='color:#888;'>(${usuario.cedula})</span>`;
              } else if (empActual) {
                info += `<b>${empActual.nombre} ${empActual.apellido}</b> &nbsp; <span style='color:#888;'>(${empActual.cedula})</span>`;
              }
              fetch('../controlador/rolesController.php?action=listar')
                .then(r => r.json())
                .then(dataRol => {
                  const selRol = document.getElementById('edit_idRol');
                  selRol.innerHTML = '<option value="">Seleccione...</option>';
                  let rolActual = null;
                  dataRol.roles.forEach(rol => {
                    selRol.innerHTML += `<option value=\"${rol.idRol}\">${rol.idRol}</option>`;
                    if (rol.idRol == usuario.idRol) rolActual = rol;
                  });
                  setTimeout(() => { selRol.value = usuario.idRol; }, 0);
                  setTimeout(() => { document.getElementById('edit_rolEmpleado').value = usuario.nombreRol || (rolActual ? rolActual.nombre : ''); }, 0);
                  if (usuario.nombreRol) info += `<br><span style='color:#555;'>Rol: <b>${usuario.nombreRol}</b></span>`;
                  else if (rolActual) info += `<br><span style='color:#555;'>Rol: <b>${rolActual.nombre}</b></span>`;
                  const infoDiv = document.getElementById('infoEditarUsuario');
                  infoDiv.innerHTML = info;
                  infoDiv.style.display = info ? 'block' : 'none';
                  setTimeout(() => {
                    document.getElementById('edit_idUsuario').value = usuario.idUsuario;
                    document.getElementById('edit_usuario').value = usuario.usuario;
                    document.getElementById('edit_password').value = '';
                    document.getElementById('edit_estado').value = usuario.estado;
                    document.getElementById('modalEditarUsuario').style.display = 'flex';
                  }, 0);
                });
            });
          document.getElementById('edit_idRol').onchange = function() {
            const idRol = this.value;
            fetch('../controlador/rolesController.php?action=listar')
              .then(r => r.json())
              .then(dataRol => {
                const rolObj = dataRol.roles.find(r => r.idRol == idRol);
                document.getElementById('edit_rolEmpleado').value = rolObj ? rolObj.nombre : '';
              });
          };
          document.getElementById('edit_idUsuario').value = usuario.idUsuario;
          // El usuario se autocompleta arriba
          document.getElementById('edit_password').value = '';
          document.getElementById('edit_estado').value = usuario.estado;
          document.getElementById('modalEditarUsuario').style.display = 'flex';

          // Validación en tiempo real de contraseña en edición
          const editPasswordInput = document.getElementById('edit_password');
          editPasswordInput.oninput = function() {
            const val = editPasswordInput.value;
            if (val.length > 0 && val.length < 10) {
              editPasswordInput.setCustomValidity('La contraseña debe tener al menos 10 caracteres.');
            } else if (val.length > 0 && !/[0-9]/.test(val)) {
              editPasswordInput.setCustomValidity('La contraseña debe contener al menos un número.');
            } else if (val.length > 0 && !/[!@#$%^&*()_+\-=[\]{};':"\\|,.<>/?]/.test(val)) {
              editPasswordInput.setCustomValidity('La contraseña debe contener al menos un caracter especial.');
            } else if (val.length === 0) {
              editPasswordInput.setCustomValidity(''); // Permitir vacío para no cambiar
            } else {
              editPasswordInput.setCustomValidity('');
            }
          };
        }
        document.getElementById('cerrarModalEditarUsuario').onclick = function() {
          document.getElementById('modalEditarUsuario').style.display = 'none';
          document.getElementById('msg-editar-usuario').textContent = '';
        };
        document.getElementById('formEditarUsuario').onsubmit = function(e) {
          e.preventDefault();
          const idUsuario = document.getElementById('edit_idUsuario').value;
          const idEmpleado = document.getElementById('edit_idEmpleado').value;
          const idRol = document.getElementById('edit_idRol').value;
          const usuario = document.getElementById('edit_usuario').value;
          const password = document.getElementById('edit_password').value;
          const estado = document.getElementById('edit_estado').value;
          const editPasswordInput = document.getElementById('edit_password');
          const msg = document.getElementById('msg-editar-usuario');
          if (usuario.length === 0 || usuario.length > 50) {
            msg.textContent = 'El usuario debe tener máximo 50 caracteres.';
            msg.style.color = 'red';
            return;
          }
          if (editPasswordInput.value.length > 0 && editPasswordInput.validationMessage) {
            msg.textContent = editPasswordInput.validationMessage;
            msg.style.color = 'red';
            editPasswordInput.reportValidity();
            return;
          }
          fetch('../controlador/usuarios/editarUsuario.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: `idUsuario=${encodeURIComponent(idUsuario)}&idEmpleado=${encodeURIComponent(idEmpleado)}&idRol=${encodeURIComponent(idRol)}&usuario=${encodeURIComponent(usuario)}&password=${encodeURIComponent(password)}&estado=${encodeURIComponent(estado)}`
          })
          .then(r => r.json())
          .then(data => {
            msg.textContent = data.message;
            msg.style.color = data.success ? 'green' : 'red';
            if (data.success) {
              setTimeout(() => {
                document.getElementById('modalEditarUsuario').style.display = 'none';
                msg.textContent = '';
                cargarUsuarios();
              }, 1200);
            }
          })
          .catch(() => {
            msg.textContent = 'Error de conexión con el servidor.';
            msg.style.color = 'red';
          });
        };
        // Eliminar usuario
        window.eliminarUsuario = function(idUsuario) {
          if (!confirm('¿Está seguro de eliminar este usuario?')) return;
          fetch('../controlador/usuarios/eliminarUsuario.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: `idUsuario=${encodeURIComponent(idUsuario)}`
          })
          .then(r => r.json())
          .then(data => {
            alert(data.message);
            if (data.success) cargarUsuarios();
          })
          .catch(() => alert('Error de conexión con el servidor.'));
        };
        paginacionContainer.appendChild(select);
        paginacionContainer.appendChild(controls);
        // Renderizar tabla paginada
              function renderTabla() {
                let html = `<table id="tablaUsuarios" style="width:100%; table-layout:fixed; border-collapse:collapse; background:#fff; box-shadow:0 2px 8px rgba(0,0,0,0.04);">
            <colgroup>
              <col style="min-width:90px; max-width:110px; width:100px;">
              <col style="min-width:120px; max-width:180px; width:150px;">
              <col style="min-width:120px; max-width:180px; width:150px;">
              <col style="min-width:120px; max-width:180px; width:150px;">
              <col style="min-width:180px; max-width:220px; width:200px;">
            </colgroup>
            <thead>
              <tr style="background:#f4f4f4;">
                <th style="padding:10px; border:1px solid #ddd;">ID Usuario</th>
                <th style="padding:10px; border:1px solid #ddd;">Empleado (Cédula)</th>
                <th style="padding:10px; border:1px solid #ddd;">Rol</th>
                <th style="padding:10px; border:1px solid #ddd;">Estado</th>
                <th style="padding:10px; border:1px solid #ddd;">Acciones</th>
              </tr>
            </thead>
            <tbody>`;
          const start = (currentPage-1)*pageSize;
          const end = start + pageSize;
          usuarios.slice(start, end).forEach(usuario => {
            html += `<tr>
              <td style=\"padding:10px; border:1px solid #ddd;\">${usuario.idUsuario}</td>
              <td style=\"padding:10px; border:1px solid #ddd;\">${usuario.cedula}</td>
              <td style=\"padding:10px; border:1px solid #ddd;\">${usuario.nombreRol || usuario.rol}</td>
              <td style="padding:10px; border:1px solid #ddd; text-align:center;">${usuario.estado === 'activo' ? '<span style=\'background:#27ae60; color:#fff; padding:4px 12px; border-radius:4px; font-weight:600;\'>Activo</span>' : '<span style=\'background:#c0392b; color:#fff; padding:4px 12px; border-radius:4px; font-weight:600;\'>Inactivo</span>'}</td>
              <td style=\"padding:10px; border:1px solid #ddd;\">
                <button onclick="window._editarUsuario && window._editarUsuario(${encodeURIComponent(usuario.idUsuario)})" style=\"background:#2980b9; color:#fff; border:none; padding:6px 12px; border-radius:4px; margin-right:6px; cursor:pointer;\">Editar</button>
                <button onclick="eliminarUsuario(${encodeURIComponent(usuario.idUsuario)})" style=\"background:${usuario.estado === 'activo' ? '#e74c3c' : '#27ae60'}; color:#fff; border:none; padding:6px 12px; border-radius:4px; cursor:pointer;\">Eliminar</button>
              </td>
            </tr>`;
          });
          html += '</tbody></table>';
          document.getElementById('tabla-usuarios').innerHTML = '';
          document.getElementById('tabla-usuarios').appendChild(paginacionContainer);
          const tablaDiv = document.createElement('div');
          tablaDiv.innerHTML = html;
          document.getElementById('tabla-usuarios').appendChild(tablaDiv);
          // Actualizar info de página
          const totalPages = Math.ceil(usuarios.length / pageSize) || 1;
          pageInfo.textContent = `Página ${currentPage} de ${totalPages}`;
          btnPrev.disabled = currentPage === 1;
          btnNext.disabled = currentPage === totalPages;
        }
        // Eventos
        select.addEventListener('change', function() {
          pageSize = parseInt(this.value);
          currentPage = 1;
          renderTabla();
        });
        btnPrev.addEventListener('click', function() {
          if (currentPage > 1) {
            currentPage--;
            renderTabla();
          }
        });
        btnNext.addEventListener('click', function() {
          const totalPages = Math.ceil(usuarios.length / pageSize) || 1;
          if (currentPage < totalPages) {
            currentPage++;
            renderTabla();
          }
        });
        renderTabla();
        // Handler global para editar
        window._editarUsuario = function(idUsuario) {
          const usuario = usuarios.find(u => u.idUsuario == idUsuario);
          if (usuario) abrirModalEditar(usuario);
        };
      }
    });
}
