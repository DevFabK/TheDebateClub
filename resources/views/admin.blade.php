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
            <div class="filtros-usuarios mb-4">
                <input type="text" id="filtro-nombre" placeholder="Filtrar por nombre" class="input-filtro">

                <select id="filtro-rol" class="input-filtro">
                    <option value="">Todos los roles</option>
                    @foreach ($roles as $rol)
                        @if (strtolower($rol->nombre) !== 'visitante')
                            <option value="{{ strtolower($rol->nombre) }}">{{ $rol->nombre }}</option>
                        @endif
                    @endforeach
                </select>

                <input type="number" id="filtro-puntos-min" placeholder="Puntos mín." class="input-filtro" min="0">
                <input type="number" id="filtro-puntos-max" placeholder="Puntos máx." class="input-filtro" min="0">

                <button id="btn-aplicar-filtros-usuarios" class="btn btn-primary">Aplicar filtros</button>
                <button id="btn-limpiar-filtros-usuarios" class="btn btn-secondary">Limpiar filtros</button>
            </div>
            <div class="tabla-scroll">

                <table class="admin-table" id="tabla-usuarios">
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
                                        <input type="text" name="nombre" value="{{ $user->nombre }}"
                                            class="input-nombre" style="display:none;">
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
                                        <button type="button" class="btn-edit"
                                            onclick="activarEdicion(this)">Editar</button>
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
        </div>

        <!-- TEMAS -->
        <div class="admin-tab-content" id="temas" style="display: none;">
            <h3>Temas de debate</h3>
            <div class="filtros-temas mb-4">
                <input type="text" id="filtro-titulo" placeholder="Filtrar por título" class="input-filtro">

                <select id="filtro-creador" class="input-filtro">
                    <option value="">Todos los creadores</option>
                    @foreach ($usuarios as $user)
                        <option value="{{ strtolower($user->nombre) }}">{{ $user->nombre }}</option>
                    @endforeach
                </select>

                <button id="btn-aplicar-filtros-temas" class="btn btn-primary">Aplicar filtros</button>
                <button id="btn-limpiar-filtros-temas" class="btn btn-secondary">Limpiar filtros</button>
            </div>
            <div class="tabla-scroll">
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
                                <td>{{ $tema->id }}</td>
                                <td>
                                    <span class="texto-titulo">{{ $tema->titulo }}</span>
                                    <input type="text" name="titulo" value="{{ $tema->titulo }}"
                                        style="display:none;">
                                </td>
                                <td>
                                    <span class="texto-descripcion">{{ $tema->descripcion }}</span>
                                    <input type="text" name="descripcion" value="{{ $tema->descripcion }}"
                                        style="display:none;">
                                </td>
                                <td>{{ $tema->usuario->nombre ?? 'Desconocido' }}</td>
                                <td>
                                    <form method="POST" action="{{ route('admin.temas.actualizar', $tema) }}"
                                        class="editar-form">
                                        @csrf
                                        @method('PUT')
                                        <button type="button" class="btn-edit"
                                            onclick="activarEdicion(this)">Editar</button>
                                        <button type="submit" class="btn-save" style="display:none;">Guardar</button>
                                        <button type="button" class="btn-cancel" style="display:none;"
                                            onclick="cancelarEdicion(this)">Cancelar</button>
                                    </form>
                                </td>
                                <td>
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
        </div>


        <!-- DEBATES -->
        <div class="admin-tab-content" id="debates" style="display: none;">
            <h3>Debates</h3>

            <div class="filtros-debates mb-4">
                <input type="text" id="filtro-titulo-debate" placeholder="Filtrar por título" class="input-filtro">

                <select id="filtro-usuario-debate" class="input-filtro">
                    <option value="">Todos los usuarios</option>
                    @foreach ($usuarios as $usuario)
                        <option value="{{ strtolower($usuario->nombre) }}">{{ $usuario->nombre }}</option>
                    @endforeach
                </select>

                <select id="filtro-tema-debate" class="input-filtro">
                    <option value="">Todos los temas</option>
                    @foreach ($temas as $tema)
                        <option value="{{ strtolower($tema->titulo) }}">{{ $tema->titulo }}</option>
                    @endforeach
                </select>

                <button id="btn-aplicar-filtros-debates" class="btn btn-primary">Aplicar filtros</button>
                <button id="btn-limpiar-filtros-debates" class="btn btn-secondary">Limpiar filtros</button>
            </div>

            <div class="tabla-scroll">
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
                                                    @if ($debate->usuario_id == $usuario->id) selected @endif>
                                                    {{ $usuario->nombre }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </td>

                                    <td>
                                        <span class="texto-tema">{{ $debate->tema->titulo ?? 'Desconocido' }}</span>
                                        <select name="tema_id" style="display:none; width: 90%;">
                                            @foreach ($temas as $tema)
                                                <option value="{{ $tema->id }}"
                                                    @if ($debate->tema_id == $tema->id) selected @endif>
                                                    {{ $tema->titulo }}
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
                                        <button type="button" class="btn-edit"
                                            onclick="activarEdicion(this)">Editar</button>
                                        <button type="submit" class="btn-save" style="display:none;">Guardar</button>
                                        <button type="button" class="btn-cancel" style="display:none;"
                                            onclick="cancelarEdicion(this)">Cancelar</button>
                                    </td>
                                </form>

                                <td>
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
        </div>

        <!-- ARGUMENTOS -->
        <div class="admin-tab-content" id="argumentos" style="display: none;">
            <h3>Argumentos</h3>

            <div class="filtros-argumentos mb-4">
                <input type="text" id="filtro-contenido-argumento" placeholder="Filtrar por contenido"
                    class="input-filtro">

                <select id="filtro-postura-argumento" class="input-filtro">
                    <option value="">Todas las posturas</option>
                    <option value="a favor">A favor</option>
                    <option value="parcialmente a favor">Parcialmente a favor</option>
                    <option value="neutral">Neutral</option>
                    <option value="parcialmente en contra">Parcialmente en contra</option>
                    <option value="en contra">En contra</option>
                </select>

                <select id="filtro-debate-argumento" class="input-filtro">
                    <option value="">Todos los debates</option>
                    @foreach ($debates as $debate)
                        <option value="{{ strtolower($debate->titulo) }}">{{ $debate->titulo }}</option>
                    @endforeach
                </select>

                <select id="filtro-usuario-argumento" class="input-filtro">
                    <option value="">Todos los usuarios</option>
                    @foreach ($usuarios as $usuario)
                        <option value="{{ strtolower($usuario->nombre) }}">{{ $usuario->nombre }}</option>
                    @endforeach
                </select>

                <button id="btn-aplicar-filtros-argumentos" class="btn btn-primary">Aplicar filtros</button>
                <button id="btn-limpiar-filtros-argumentos" class="btn btn-secondary">Limpiar filtros</button>
            </div>

            <div class="tabla-scroll">
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
                        @foreach ($argumentos as $argumento)
                            <tr>
                                <form method="POST" action="{{ route('admin.argumentos.actualizar', $argumento) }}"
                                    class="editar-form">
                                    @csrf
                                    @method('PUT')
                                    <td>{{ $argumento->id }}</td>

                                    <td>
                                        <div class="contenido-argumento-admin"
                                            data-contenido="{{ e($argumento->contenido) }}">
                                            {{ $argumento->contenido }}
                                        </div>
                                        <input type="text" name="contenido" style="display:none; width: 90%;"
                                            value="{{ $argumento->contenido }}">
                                    </td>

                                    <td>
                                        <span class="texto-postura">{{ $argumento->postura }}</span>
                                        <select name="postura" style="display:none;">
                                            <option value="A favor"
                                                {{ $argumento->postura === 'A favor' ? 'selected' : '' }}>A favor</option>
                                            <option value="Parcialmente a favor"
                                                {{ $argumento->postura === 'Parcialmente a favor' ? 'selected' : '' }}>
                                                Parcialmente a favor</option>
                                            <option value="Neutral"
                                                {{ $argumento->postura === 'Neutral' ? 'selected' : '' }}>Neutral</option>
                                            <option value="Parcialmente en contra"
                                                {{ $argumento->postura === 'Parcialmente en contra' ? 'selected' : '' }}>
                                                Parcialmente en contra</option>
                                            <option value="En contra"
                                                {{ $argumento->postura === 'En contra' ? 'selected' : '' }}>En contra
                                            </option>
                                        </select>
                                    </td>

                                    <td>
                                        <span
                                            class="texto-debate">{{ $argumento->debate->titulo ?? 'Desconocido' }}</span>
                                    </td>

                                    <td>
                                        <span
                                            class="texto-usuario">{{ $argumento->usuario->nombre ?? 'Desconocido' }}</span>
                                    </td>

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

                // Guardar los valores originales en data-attributes para restaurar después
                fila.querySelectorAll('input, select, textarea').forEach(input => {
                    input.dataset.originalValue = input.value;
                });

                // Ocultar elementos de texto (span, div, etc) excepto botones
                fila.querySelectorAll('span, div').forEach(el => {
                    // No ocultar si es botón o contiene botones
                    if (!el.classList.contains('btn-edit') && !el.classList.contains('btn-save') && !el.classList
                        .contains('btn-cancel')) {
                        el.style.display = 'none';
                    }
                });

                // Mostrar inputs, selects, textareas para editar
                fila.querySelectorAll('input, select, textarea').forEach(input => {
                    input.style.display = 'inline-block';
                });

                // Mostrar/ocultar botones
                button.style.display = 'none'; // botón editar
                const btnSave = fila.querySelector('.btn-save');
                const btnCancel = fila.querySelector('.btn-cancel');
                if (btnSave) btnSave.style.display = 'inline-block';
                if (btnCancel) btnCancel.style.display = 'inline-block';
            }

            function cancelarEdicion(button) {
                const fila = button.closest('tr');

                // Restaurar los valores originales
                fila.querySelectorAll('input, select, textarea').forEach(input => {
                    if (input.dataset.originalValue !== undefined) {
                        input.value = input.dataset.originalValue;
                    }
                });

                // Mostrar elementos de texto otra vez
                fila.querySelectorAll('span, div').forEach(el => {
                    if (!el.classList.contains('btn-edit') && !el.classList.contains('btn-save') && !el.classList
                        .contains('btn-cancel')) {
                        el.style.display = '';
                    }
                });

                // Ocultar inputs, selects, textareas
                fila.querySelectorAll('input, select, textarea').forEach(input => {
                    input.style.display = 'none';
                });

                // Mostrar/ocultar botones
                const btnEdit = fila.querySelector('.btn-edit');
                if (btnEdit) btnEdit.style.display = 'inline-block';
                const btnSave = fila.querySelector('.btn-save');
                if (btnSave) btnSave.style.display = 'none';
                button.style.display = 'none'; // botón cancelar
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
                document.querySelectorAll('.contenido-argumento-admin').forEach(div => {
                    const markdown = div.dataset.contenido;
                    div.innerHTML = marked.parse(markdown);
                });
            });
            document.addEventListener('DOMContentLoaded', () => {
                document.querySelectorAll('.contenido-argumento-admin').forEach(div => {
                    const markdown = div.dataset.contenido;
                    div.innerHTML = marked.parse(markdown);
                });
            });
            document.addEventListener('DOMContentLoaded', function() {
                // --- FILTROS USUARIOS ---
                const tablaUsuarios = document.getElementById('tabla-usuarios');
                if (tablaUsuarios) {
                    const filasUsuarios = tablaUsuarios.querySelectorAll('tbody tr');

                    const inputNombre = document.getElementById('filtro-nombre');
                    const selectRol = document.getElementById('filtro-rol');
                    const inputPuntosMin = document.getElementById('filtro-puntos-min');
                    const inputPuntosMax = document.getElementById('filtro-puntos-max');

                    const btnAplicarUsuarios = document.getElementById('btn-aplicar-filtros-usuarios');
                    const btnLimpiarUsuarios = document.getElementById('btn-limpiar-filtros-usuarios');

                    function aplicarFiltrosUsuarios() {
                        const nombreFiltro = inputNombre.value.trim().toLowerCase();
                        const rolFiltro = selectRol.value.trim().toLowerCase();
                        const puntosMin = inputPuntosMin.value ? parseInt(inputPuntosMin.value) : 0;
                        const puntosMax = inputPuntosMax.value ? parseInt(inputPuntosMax.value) : Infinity;

                        filasUsuarios.forEach(fila => {
                            const celdas = fila.querySelectorAll('td');

                            const nombre = celdas[1].textContent.trim().toLowerCase();
                            const rolSpan = celdas[3].querySelector('.texto-rol');
                            const rol = rolSpan ? rolSpan.textContent.trim().toLowerCase() : '';
                            const puntos = parseInt(celdas[4].textContent.trim()) || 0;

                            const coincideNombre = nombre.includes(nombreFiltro);
                            const coincideRol = rolFiltro === '' || rol === rolFiltro;
                            const coincidePuntos = puntos >= puntosMin && puntos <= puntosMax;

                            fila.style.display = (coincideNombre && coincideRol && coincidePuntos) ? '' :
                                'none';
                        });
                    }

                    function limpiarFiltrosUsuarios() {
                        inputNombre.value = '';
                        selectRol.value = '';
                        inputPuntosMin.value = '';
                        inputPuntosMax.value = '';
                        aplicarFiltrosUsuarios();
                    }

                    btnAplicarUsuarios.addEventListener('click', aplicarFiltrosUsuarios);
                    btnLimpiarUsuarios.addEventListener('click', limpiarFiltrosUsuarios);

                    // Aplicar filtros al cargar para mostrar todos por defecto
                    aplicarFiltrosUsuarios();
                }
            });
            document.addEventListener('DOMContentLoaded', () => {
                const tablaTemas = document.querySelector('#temas table');
                if (!tablaTemas) return;

                const filasTemas = tablaTemas.querySelectorAll('tbody tr');

                const inputTitulo = document.getElementById('filtro-titulo');
                const selectCreador = document.getElementById('filtro-creador');

                const btnAplicarTemas = document.getElementById('btn-aplicar-filtros-temas');
                const btnLimpiarTemas = document.getElementById('btn-limpiar-filtros-temas');

                function normalizarTexto(texto) {
                    return texto.normalize('NFD').replace(/[\u0300-\u036f]/g, '').toLowerCase().trim();
                }

                function aplicarFiltrosTemas() {
                    const filtroTitulo = normalizarTexto(inputTitulo.value);
                    const filtroCreador = normalizarTexto(selectCreador.value);

                    filasTemas.forEach(fila => {
                        const celdas = fila.querySelectorAll('td');

                        // Título está en la 2ª celda (índice 1), dentro del span .texto-titulo
                        const tituloSpan = celdas[1].querySelector('.texto-titulo');
                        const titulo = tituloSpan ? normalizarTexto(tituloSpan.textContent) : '';

                        // Creador está en la 4ª celda (índice 3)
                        const creador = celdas[3] ? normalizarTexto(celdas[3].textContent) : '';

                        const coincideTitulo = titulo.includes(filtroTitulo);
                        const coincideCreador = filtroCreador === '' || creador === filtroCreador;

                        fila.style.display = (coincideTitulo && coincideCreador) ? '' : 'none';
                    });
                }

                function limpiarFiltrosTemas() {
                    inputTitulo.value = '';
                    selectCreador.value = '';
                    filasTemas.forEach(fila => fila.style.display = '');
                }

                btnAplicarTemas.addEventListener('click', aplicarFiltrosTemas);
                btnLimpiarTemas.addEventListener('click', limpiarFiltrosTemas);

                // Mostrar todo al cargar la página
                limpiarFiltrosTemas();
            });
            document.addEventListener('DOMContentLoaded', () => {
                const tablaDebates = document.querySelector('#debates table');
                if (!tablaDebates) return;

                const filasDebates = tablaDebates.querySelectorAll('tbody tr');

                const inputTitulo = document.getElementById('filtro-titulo-debate');
                const selectUsuario = document.getElementById('filtro-usuario-debate');
                const selectTema = document.getElementById('filtro-tema-debate');

                const btnAplicar = document.getElementById('btn-aplicar-filtros-debates');
                const btnLimpiar = document.getElementById('btn-limpiar-filtros-debates');

                function normalizarTexto(texto) {
                    return texto.normalize('NFD').replace(/[\u0300-\u036f]/g, '').toLowerCase().trim();
                }

                function aplicarFiltros() {
                    const filtroTitulo = normalizarTexto(inputTitulo.value);
                    const filtroUsuario = normalizarTexto(selectUsuario.value);
                    const filtroTema = normalizarTexto(selectTema.value);

                    filasDebates.forEach(fila => {
                        const celdas = fila.querySelectorAll('td');

                        const tituloSpan = celdas[1].querySelector('.texto-titulo');
                        const usuarioSpan = celdas[2].querySelector('.texto-usuario');
                        const temaSpan = celdas[3].querySelector('.texto-tema');

                        const titulo = tituloSpan ? normalizarTexto(tituloSpan.textContent) : '';
                        const usuario = usuarioSpan ? normalizarTexto(usuarioSpan.textContent) : '';
                        const tema = temaSpan ? normalizarTexto(temaSpan.textContent) : '';

                        const coincideTitulo = titulo.includes(filtroTitulo);
                        const coincideUsuario = filtroUsuario === '' || usuario === filtroUsuario;
                        const coincideTema = filtroTema === '' || tema === filtroTema;

                        fila.style.display = (coincideTitulo && coincideUsuario && coincideTema) ? '' : 'none';
                    });
                }

                function limpiarFiltros() {
                    inputTitulo.value = '';
                    selectUsuario.value = '';
                    selectTema.value = '';
                    filasDebates.forEach(fila => fila.style.display = '');
                }

                btnAplicar.addEventListener('click', aplicarFiltros);
                btnLimpiar.addEventListener('click', limpiarFiltros);

                // Mostrar todo al cargar
                limpiarFiltros();
            });
            document.addEventListener('DOMContentLoaded', () => {
                const tablaArgumentos = document.querySelector('#argumentos table');
                if (!tablaArgumentos) return;

                const filasArgumentos = tablaArgumentos.querySelectorAll('tbody tr');

                const inputContenido = document.getElementById('filtro-contenido-argumento');
                const selectPostura = document.getElementById('filtro-postura-argumento');
                const selectDebate = document.getElementById('filtro-debate-argumento');
                const selectUsuario = document.getElementById('filtro-usuario-argumento');

                function normalizarTexto(texto) {
                    return texto.normalize('NFD').replace(/[\u0300-\u036f]/g, '').toLowerCase().trim();
                }

                function aplicarFiltrosArgumentos() {
                    const filtroContenido = normalizarTexto(inputContenido.value);
                    const filtroPostura = normalizarTexto(selectPostura.value);
                    const filtroDebate = normalizarTexto(selectDebate.value);
                    const filtroUsuario = normalizarTexto(selectUsuario.value);

                    filasArgumentos.forEach(fila => {
                        const celdas = fila.querySelectorAll('td');

                        const contenidoDiv = fila.querySelector('.contenido-argumento-admin');
                        const posturaSpan = fila.querySelector('.texto-postura');
                        const debateSpan = fila.querySelector('.texto-debate');
                        const usuarioSpan = fila.querySelector('.texto-usuario');

                        const contenido = contenidoDiv ? normalizarTexto(contenidoDiv.textContent) : '';
                        const postura = posturaSpan ? normalizarTexto(posturaSpan.textContent) : '';
                        const debate = debateSpan ? normalizarTexto(debateSpan.textContent) : '';
                        const usuario = usuarioSpan ? normalizarTexto(usuarioSpan.textContent) : '';

                        const coincideContenido = contenido.includes(filtroContenido);
                        const coincidePostura = filtroPostura === '' || postura === filtroPostura;
                        const coincideDebate = filtroDebate === '' || debate === filtroDebate;
                        const coincideUsuario = filtroUsuario === '' || usuario === filtroUsuario;

                        fila.style.display = (coincideContenido && coincidePostura && coincideDebate &&
                            coincideUsuario) ? '' : 'none';
                    });
                }

                function limpiarFiltrosArgumentos() {
                    inputContenido.value = '';
                    selectPostura.value = '';
                    selectDebate.value = '';
                    selectUsuario.value = '';
                    filasArgumentos.forEach(fila => fila.style.display = '');
                }

                document.getElementById('btn-aplicar-filtros-argumentos').addEventListener('click',
                    aplicarFiltrosArgumentos);
                document.getElementById('btn-limpiar-filtros-argumentos').addEventListener('click',
                    limpiarFiltrosArgumentos);

                // Mostrar todo al cargar
                limpiarFiltrosArgumentos();
            });
        </script>
        <script src="https://cdn.jsdelivr.net/npm/marked/marked.min.js"></script>
    @endsection
