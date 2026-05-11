<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Plantas</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Segoe UI', sans-serif;
            background: #f0f4f0;
            color: #2d3a2d;
            padding: 2rem;
        }

        h1 { font-size: 1.8rem; margin-bottom: 1.5rem; color: #2e6b3e; }
        h2 { font-size: 1.2rem; margin-bottom: 1rem; color: #3a5a3a; }

        .container { max-width: 860px; margin: 0 auto; }

        /* Alerta de éxito */
        .alert {
            background: #d4edda;
            border: 1px solid #a3d9a5;
            color: #2d6a4f;
            padding: .75rem 1rem;
            border-radius: 6px;
            margin-bottom: 1.5rem;
        }

        /* Formulario */
        .card {
            background: white;
            border-radius: 10px;
            padding: 1.5rem;
            margin-bottom: 2rem;
            box-shadow: 0 2px 8px rgba(0,0,0,0.07);
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
        }

        .form-group { display: flex; flex-direction: column; gap: .4rem; }
        .form-group.full { grid-column: 1 / -1; }

        label { font-size: .85rem; font-weight: 600; color: #4a6a4a; }

        input, textarea {
            padding: .55rem .75rem;
            border: 1px solid #c8dfc8;
            border-radius: 6px;
            font-size: .95rem;
            transition: border-color .2s;
            background: #fafffe;
        }

        input:focus, textarea:focus {
            outline: none;
            border-color: #2e6b3e;
        }

        textarea { resize: vertical; min-height: 80px; }

        .error { color: #c0392b; font-size: .8rem; margin-top: .2rem; }

        .btn-submit {
            margin-top: 1.1rem;
            background: #2e6b3e;
            color: white;
            border: none;
            padding: .65rem 1.6rem;
            border-radius: 6px;
            font-size: 1rem;
            cursor: pointer;
            transition: background .2s;
        }

        .btn-submit:hover { background: #245530; }

        /* Tabla */
        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0,0,0,0.07);
        }

        thead { background: #2e6b3e; color: white; }
        th, td { padding: .75rem 1rem; text-align: left; font-size: .92rem; }
        tbody tr:nth-child(even) { background: #f5faf5; }
        tbody tr:hover { background: #eaf3ea; }

        .badge {
            font-size: .78rem;
            background: #d4edda;
            color: #2d6a4f;
            padding: .2rem .55rem;
            border-radius: 20px;
            font-style: italic;
        }

        .btn-delete {
            background: none;
            border: 1px solid #c0392b;
            color: #c0392b;
            padding: .35rem .8rem;
            border-radius: 5px;
            font-size: .85rem;
            cursor: pointer;
            transition: all .2s;
        }

        .btn-delete:hover { background: #c0392b; color: white; }

        .empty {
            text-align: center;
            padding: 2rem;
            color: #7a9a7a;
            font-style: italic;
        }
    </style>
</head>
<body>
<div class="container">

    <h1>🌿 Registro de Plantas</h1>

    {{-- Mensaje de éxito --}}
    @if(session('success'))
        <div class="alert">{{ session('success') }}</div>
    @endif

    {{-- Formulario de registro --}}
    <div class="card">
        <h2>Nueva planta</h2>
        <form action="{{ route('plantas.store') }}" method="POST">
            @csrf
            <div class="form-grid">

                <div class="form-group">
                    <label for="nombre">Nombre común</label>
                    <input type="text" id="nombre" name="nombre"
                           value="{{ old('nombre') }}" placeholder="Ej. Albahaca">
                    @error('nombre') <span class="error">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label for="especie">Especie</label>
                    <input type="text" id="especie" name="especie"
                           value="{{ old('especie') }}" placeholder="Ej. Ocimum basilicum">
                    @error('especie') <span class="error">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label for="fecha_registro">Fecha de registro</label>
                    <input type="date" id="fecha_registro" name="fecha_registro"
                           value="{{ old('fecha_registro') }}">
                    @error('fecha_registro') <span class="error">{{ $message }}</span> @enderror
                </div>

                <div class="form-group full">
                    <label for="descripcion">Descripción</label>
                    <textarea id="descripcion" name="descripcion"
                              placeholder="Notas sobre la planta...">{{ old('descripcion') }}</textarea>
                    @error('descripcion') <span class="error">{{ $message }}</span> @enderror
                </div>

            </div>
            <button type="submit" class="btn-submit">＋ Registrar planta</button>
        </form>
    </div>

    {{-- Tabla de plantas --}}
    <h2>Plantas registradas ({{ $plantas->count() }})</h2>

    @if($plantas->isEmpty())
        <p class="empty">No hay plantas registradas aún.</p>
    @else
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nombre</th>
                    <th>Especie</th>
                    <th>Descripción</th>
                    <th>Fecha</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody>
                @foreach($plantas as $planta)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td><strong>{{ $planta->nombre }}</strong></td>
                    <td><span class="badge">{{ $planta->especie }}</span></td>
                    <td>{{ $planta->descripcion ?? '—' }}</td>
                    <td>{{ \Carbon\Carbon::parse($planta->fecha_registro)->format('d/m/Y') }}</td>
                    <td>
                        <form action="{{ route('plantas.destroy', $planta) }}"
                              method="POST"
                              onsubmit="return confirm('¿Eliminar esta planta?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-delete">Eliminar</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif

</div>
</body>
</html>
