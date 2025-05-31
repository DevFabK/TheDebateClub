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
            <button class="tab-button" data-tab="temas">Temas</button>
            <button class="tab-button" data-tab="debates">Debates</button>
            <button class="tab-button" data-tab="argumentos">Argumentos</button>
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
        </div>

        <!-- TEMAS -->

        <div class="admin-tab-content" id="temas" style="display: none;">
            <h3>Temas de debate</h3>

            <table class="admin-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Título</th>
                        <th>Descripción</th>
                        <th>Creado por</th>
                        <th>Acciones</th>
                        <th>Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($temas as $tema)
                        <tr>
                            <form method="POST" action="{{ route('admin.temas.actualizar', $tema) }}" class="editar-form">
                                @csrf
                                @method('PUT')

                                <td>{{ $tema->id }}</td>
                                <td>
                                    <span class="texto-titulo">{{ $tema->titulo }}</span>
                                    <input type="text" name="titulo" value="{{ $tema->titulo }}" style="display:none;">
                                </td>
                                <td>
                                    <span class="texto-descripcion">{{ $tema->descripcion }}</span>
                                    <input type="text" name="descripcion" value="{{ $tema->descripcion }}"
                                        style="display: none;">
                                </td>
                                <td>
                                    {{ $tema->usuario->nombre ?? 'Desconocido' }}
                                </td>
                                <td>
                                    <!-- Botones edición -->
                                    <button type="button" class="btn-edit" onclick="activarEdicion(this)">Editar</button>
                                    <button type="submit" class="btn-save" style="display:none;">Guardar</button>
                                    <button type="button" class="btn-cancel" style="display:none;"
                                        onclick="cancelarEdicion(this)">Cancelar</button>
                                </td>
                            </form>
                            <td>
                                <!-- Formulario separado para eliminar -->
                                <form method="POST" action="{{ route('admin.temas.eliminar', $tema) }}"
                                    class="form-eliminar">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-delete"
                                        data-nombre="{{ $tema->titulo }}">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- DEBATES -->

        <div class="admin-tab-content" id="debates" style="display: none;">
            <h3>Debates</h3>
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Título</th>
                        <th>Usuario</th>
                        <th>Tema</th>
                        <th>Descripción</th>
                        <th>Acciones</th>
                        <th>Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($debates as $debate)
                        <tr>
                            <form method="POST" action="{{ route('admin.debates.actualizar', $debate) }}"
                                class="editar-form">
                                @csrf
                                @method('PUT')

                                <td>{{ $debate->id }}</td>

                                <td>
                                    <span class="texto-titulo">{{ $debate->titulo }}</span>
                                    <input type="text" name="titulo" value="{{ $debate->titulo }}"
                                        style="display:none; width: 90%;">
                                </td>

                                <td>
                                    <span class="texto-usuario">{{ $debate->usuario->nombre ?? 'Desconocido' }}</span>
                                    <select name="usuario_id" style="display:none; width: 90%;">
                                        <option value="">-- Sin usuario --</option>
                                        @foreach ($usuarios as $usuario)
                                            <option value="{{ $usuario->id }}"
                                                @if ($debate->usuario_id == $usuario->id) selected @endif>{{ $usuario->nombre }}
                                            </option>
                                        @endforeach
                                    </select>
                                </td>

                                <td>
                                    <span class="texto-tema">{{ $debate->tema->titulo ?? 'Desconocido' }}</span>
                                    <select name="tema_id" style="display:none; width: 90%;">
                                        @foreach ($temas as $tema)
                                            <option value="{{ $tema->id }}"
                                                @if ($debate->tema_id == $tema->id) selected @endif>{{ $tema->titulo }}
                                            </option>
                                        @endforeach
                                    </select>
                                </td>

                                <td>
                                    <span class="texto-descripcion">{{ $debate->descripcion }}</span>
                                    <input type="text" name="descripcion" value="{{ $debate->descripcion }}"
                                        style="display:none; width: 90%;">
                                </td>

                                <td>
                                    <!-- Botones edición -->
                                    <button type="button" class="btn-edit"
                                        onclick="activarEdicion(this)">Editar</button>
                                    <button type="submit" class="btn-save" style="display:none;">Guardar</button>
                                    <button type="button" class="btn-cancel" style="display:none;"
                                        onclick="cancelarEdicion(this)">Cancelar</button>
                                </td>
                            </form>

                            <td>
                                <!-- Formulario separado para eliminar -->
                                <form method="POST" action="{{ route('admin.debates.eliminar', $debate) }}"
                                    class="form-eliminar">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-delete"
                                        data-nombre="{{ $debate->titulo }}">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- ARGUMENTOS -->

        <div class="admin-tab-content" id="argumentos" style="display: none;">
            <h3>Argumentos</h3>
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Contenido</th>
                        <th>Postura</th>
                        <th>Debate</th>
                        <th>Usuario</th>
                        <th>Acciones</th>
                        <th>Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        use Illuminate\Support\Str;
                    @endphp

                    @foreach ($argumentos as $argumento)
                        <tr>
                            <form method="POST" action="{{ route('admin.argumentos.actualizar', $argumento) }}"
                                class="editar-form">
                                @csrf
                                @method('PUT')
                                <td>{{ $argumento->id }}</td>
                                <td>
                                    <div class="contenido-argumento" data-contenido="{{ e($argumento->contenido) }}">
                                    </div>
                                    <input type="text" name="contenido" style="display:none; width: 90%;"
                                        value="{{ $argumento->contenido }}">
                                </td>
                                <td>
                                    <span class="texto-postura">{{ $argumento->postura }}</span>
                                    <select name="postura" style="display:none;">
                                        <option value="A favor" {{ $argumento->postura === 'A favor' ? 'selected' : '' }}>
                                            A favor</option>
                                        <option value="Parcialmente a favor"
                                            {{ $argumento->postura === 'Parcialmente a favor' ? 'selected' : '' }}>
                                            Parcialmente a favor</option>
                                        <option value="Neutral" {{ $argumento->postura === 'Neutral' ? 'selected' : '' }}>
                                            Neutral</option>
                                        <option value="Parcialmente en contra"
                                            {{ $argumento->postura === 'Parcialmente en contra' ? 'selected' : '' }}>
                                            Parcialmente en contra</option>
                                        <option value="En contra"
                                            {{ $argumento->postura === 'En contra' ? 'selected' : '' }}>En contra</option>
                                    </select>
                                </td>
                                <td>{{ $argumento->debate->titulo ?? 'Desconocido' }}</td>
                                <td>{{ $argumento->usuario->nombre ?? 'Desconocido' }}</td>
                                <td>
                                    <button type="button" class="btn-edit"
                                        onclick="activarEdicion(this)">Editar</button>
                                    <button type="submit" class="btn-save" style="display:none;">Guardar</button>
                                    <button type="button" class="btn-cancel" style="display:none;"
                                        onclick="cancelarEdicion(this)">Cancelar</button>
                                </td>
                            </form>
                            <td>
                                <form method="POST" action="{{ route('admin.argumentos.eliminar', $argumento) }}"
                                    class="form-eliminar">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-delete"
                                        data-nombre="argumento ID {{ $argumento->id }}">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div id="modal-eliminar" class="modal" style="display:none;">
        <div class="modal-content">
            <p id="mensaje-eliminar"></p>
            <div class="modal-buttons">
                <button id="btn-confirmar-eliminar" class="btn-eliminar">Eliminar</button>
                <button id="btn-cancelar-eliminar" class="btn-cancelar">Cancelar</button>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/marked/marked.min.js"></script>
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

            // Ocultar contenido parseado
            fila.querySelectorAll('.contenido-argumento').forEach(div => div.style.display = 'none');

            // Mostrar input para editar contenido
            fila.querySelectorAll('input[name="contenido"]').forEach(input => input.style.display = 'inline-block');

            // Ocultar texto postura y mostrar select
            fila.querySelectorAll('.texto-postura').forEach(span => span.style.display = 'none');
            fila.querySelectorAll('select[name="postura"]').forEach(select => select.style.display = 'inline-block');

            // Mostrar/ocultar botones
            button.style.display = 'none'; // botón editar
            fila.querySelector('.btn-save').style.display = 'inline-block'; // botón guardar
            fila.querySelector('.btn-cancel').style.display = 'inline-block'; // botón cancelar
        }

        function cancelarEdicion(button) {
            const fila = button.closest('tr');

            // Mostrar contenido parseado
            fila.querySelectorAll('.contenido-argumento').forEach(div => div.style.display = 'block');

            // Ocultar input para editar contenido
            fila.querySelectorAll('input[name="contenido"]').forEach(input => input.style.display = 'none');

            // Mostrar texto postura y ocultar select
            fila.querySelectorAll('.texto-postura').forEach(span => span.style.display = 'inline');
            fila.querySelectorAll('select[name="postura"]').forEach(select => select.style.display = 'none');

            // Mostrar/ocultar botones
            fila.querySelector('.btn-edit').style.display = 'inline-block'; // botón editar
            fila.querySelector('.btn-save').style.display = 'none'; // botón guardar
            button.style.display = 'none'; // botón cancelar

            // Opcional: Resetear valor del input a contenido original si quieres
            const contenidoOriginal = fila.querySelector('.contenido-argumento').dataset.contenido;
            fila.querySelector('input[name="contenido"]').value = contenidoOriginal;
        }

        document.addEventListener('DOMContentLoaded', () => {
            // Mostrar pestaña según hash en URL
            const hash = window.location.hash;
            if (hash) {
                const targetTab = document.querySelector(`.tab-button[data-tab="${hash.substring(1)}"]`);
                if (targetTab) {
                    targetTab.click();
                }
            }

            const modal = document.getElementById('modal-eliminar');
            const mensaje = document.getElementById('mensaje-eliminar');
            const btnConfirmar = document.getElementById('btn-confirmar-eliminar');
            const btnCancelar = document.getElementById('btn-cancelar-eliminar');
            let formularioAEliminar = null;

            // Evento para formularios de eliminación (usuarios, temas, etc)
            document.querySelectorAll('.form-eliminar').forEach(form => {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();

                    formularioAEliminar = this;
                    const nombre = this.querySelector('button[type="submit"]').dataset.nombre;

                    mensaje.innerHTML =
                        `Estás a punto de eliminar <strong style="text-decoration: underline dotted; text-decoration-offset: 10px;">${nombre}</strong>. Esta acción es <strong style="color: #ea2b24; text-decoration: underline;">irreversible</strong>. ¿Estás seguro de que quieres hacerlo?`;

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
        document.addEventListener('DOMContentLoaded', () => {
            document.querySelectorAll('.contenido-argumento').forEach(div => {
                const markdown = div.dataset.contenido;
                div.innerHTML = marked.parse(markdown);
            });
        });
        document.addEventListener('DOMContentLoaded', () => {
            document.querySelectorAll('.contenido-argumento').forEach(div => {
                const markdown = div.dataset.contenido;
                div.innerHTML = marked.parse(markdown);
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/marked/marked.min.js"></script>
@endsection
