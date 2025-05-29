@extends('layouts.app')

@section('title', 'Panel de Administración')

@section('styles')
    <link href="{{ asset('css/estilos-panel-admin.css') }}" rel="stylesheet" />
@endsection

@section('content')
    <div class="admin-wrapper">

        <!-- Navegación de pestañas -->
        <div class="admin-tabs">
            <button class="tab-button active" data-tab="usuarios">Usuarios</button>
            {{-- Aquí se añadirán más botones para otras pestañas --}}
        </div>

        <!-- Contenido de pestañas -->
        <div class="admin-tab-content" id="usuarios" style="display: block;">
            <h3>Usuarios registrados</h3>

            <table class="admin-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Rol</th>
                        <th>Puntos</th>
                        <th>Foto</th>
                        <th>Acciones</th>
                        <th>Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($usuarios as $user)
                        <tr data-user-id="{{ $user->id }}">
                            <!-- Formulario editar -->
                            <form method="POST" action="{{ route('admin.usuarios.actualizar', $user) }}"
                                enctype="multipart/form-data" class="editar-form">
                                @csrf
                                @method('PUT')
                                <td>{{ $user->id }}</td>
                                <td>
                                    <span class="texto-nombre">{{ $user->nombre }}</span>
                                    <input type="text" name="nombre" value="{{ $user->nombre }}" class="input-nombre"
                                        style="display:none;">
                                </td>
                                <td>
                                    <span class="texto-email">{{ $user->email }}</span>
                                    <input type="email" name="email" value="{{ $user->email }}" class="input-email"
                                        style="display:none;">
                                </td>
                                <td>
                                    <span class="rol-text texto-rol"
                                        data-value="{{ $user->rol_id ?? '' }}">{{ $user->rol->nombre ?? 'Sin rol' }}</span>
                                    <select name="rol_id" class="rol-select" style="display:none;">
                                        @foreach ($roles as $rol)
                                            <option value="{{ $rol->id }}"
                                                {{ $user->rol_id == $rol->id ? 'selected' : '' }}>{{ $rol->nombre }}
                                            </option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <span class="texto-puntos">{{ $user->puntos_de_debate }}</span>
                                    <input type="number" name="puntos_de_debate" value="{{ $user->puntos_de_debate }}"
                                        class="input-puntos" style="display:none;">
                                </td>
                                <td>
                                    @php
                                        $src = $user->foto_perfil
                                            ? asset('storage/' . $user->foto_perfil)
                                            : 'https://i.postimg.cc/kG6VYPZ7/default.jpg';
                                    @endphp

                                    <img src="{{ $src }}" alt="Foto de perfil" width="40" height="40"
                                        class="perfil-img">
                                    <input type="file" name="foto_perfil" style="display:none;" class="input-foto">
                                </td>
                                <td>
                                    <button type="button" class="btn-edit" onclick="activarEdicion(this)">Editar</button>
                                    <button type="submit" class="btn-save" style="display:none;">Guardar</button>
                                    <button type="button" class="btn-cancel" style="display:none;"
                                        onclick="cancelarEdicion(this)">Cancelar</button>
                                </td>
                            </form>

                            <!-- Formulario eliminar independiente -->
                            <td>
                                <form action="{{ route('admin.usuarios.eliminar', $user) }}" method="POST"
                                    class="form-eliminar">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-delete"
                                        data-nombre="{{ $user->nombre }}">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div id="modal-eliminar" class="modal" style="display:none;">
                <div class="modal-content">
                    <p id="mensaje-eliminar"></p>
                    <div class="modal-buttons">
                        <button id="btn-confirmar-eliminar" class="btn-eliminar">Eliminar</button>
                        <button id="btn-cancelar-eliminar" class="btn-cancelar">Cancelar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        // Control de pestañas
        const tabs = document.querySelectorAll('.tab-button');
        const contents = document.querySelectorAll('.admin-tab-content');

        tabs.forEach(tab => {
            tab.addEventListener('click', () => {
                const target = tab.dataset.tab;

                tabs.forEach(t => t.classList.remove('active'));
                tab.classList.add('active');

                contents.forEach(c => {
                    c.style.display = (c.id === target) ? 'block' : 'none';
                });
            });
        });

        // Activar modo edición en una fila
        function activarEdicion(button) {
            const fila = button.closest('tr');

            // Ocultar spans y mostrar inputs/selects
            fila.querySelectorAll('span').forEach(span => span.style.display = 'none');
            fila.querySelectorAll('input, select').forEach(el => el.style.display = 'inline-block');

            // Mostrar botones de guardar/cancelar
            fila.querySelector('.btn-edit').style.display = 'none';
            fila.querySelector('.btn-save').style.display = 'inline-block';
            fila.querySelector('.btn-cancel').style.display = 'inline-block';
        }

        // Cancelar edición y restaurar valores originales
        function cancelarEdicion(button) {
            const fila = button.closest('tr');

            // Restaurar valores de los inputs
            fila.querySelectorAll('input').forEach(input => {
                const span = fila.querySelector('.texto-' + input.name);
                if (span) input.value = span.innerText.trim();
                input.style.display = 'none';
            });

            // Restaurar selects
            fila.querySelectorAll('select').forEach(select => {
                const span = fila.querySelector('.texto-' + select.name);
                const valorOriginal = span?.dataset.value;
                if (valorOriginal !== undefined) {
                    select.value = valorOriginal;
                }
                select.style.display = 'none';
            });

            // Mostrar los spans nuevamente
            fila.querySelectorAll('span').forEach(span => span.style.display = 'inline');

            // Restaurar botones
            fila.querySelector('.btn-edit').style.display = 'inline-block';
            fila.querySelector('.btn-save').style.display = 'none';
            fila.querySelector('.btn-cancel').style.display = 'none';
        }

        document.addEventListener('DOMContentLoaded', () => {
            const modal = document.getElementById('modal-eliminar');
            const mensaje = document.getElementById('mensaje-eliminar');
            const btnConfirmar = document.getElementById('btn-confirmar-eliminar');
            const btnCancelar = document.getElementById('btn-cancelar-eliminar');
            let formularioAEliminar = null;

            document.querySelectorAll('.form-eliminar').forEach(form => {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();

                    formularioAEliminar = this;
                    const nombreUsuario = this.querySelector('button[type="submit"]').dataset
                        .nombre;

                    mensaje.innerHTML =
                        `Estás a punto de eliminar al usuario <strong style="text-decoration: underline dotted; text-decoration-offset: 10px;">${nombreUsuario}</strong>. Esta acción es <strong style="color: #ea2b24; text-decoration: underline;">irreversible</strong>. ¿Estás seguro de que quieres hacerlo?`

                    modal.style.display = 'flex';
                });
            });

            btnCancelar.addEventListener('click', () => {
                modal.style.display = 'none';
                formularioAEliminar = null;
            });

            btnConfirmar.addEventListener('click', () => {
                if (formularioAEliminar) {
                    formularioAEliminar.submit();
                }
            });

            modal.addEventListener('click', (e) => {
                if (e.target === modal) {
                    modal.style.display = 'none';
                    formularioAEliminar = null;
                }
            });
        });
    </script>
@endsection
