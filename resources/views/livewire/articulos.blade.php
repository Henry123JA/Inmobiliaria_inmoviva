<div>
    <div class="col-md-8 mb-2">
        <div class="card">
            <div class="card-body">
                @if (session()->has('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session()->get('success') }}
                    </div>
                @endif
                @if (session()->has('error'))
                    <div class="alert alert-danger" role="alert">
                        {{ session()->get('error') }}
                    </div>
                @endif
                @if ($updateArticle)
                    @include('livewire.update')
                @else
                    @include('livewire.create')
                @endif
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Código</th>
                                <th>Nombre</th>
                                <th>Tipo</th>
                                <th>Precio Unitario</th>
                                <th>Precio Mayor</th>
                                <th>Precio Promedio</th>
                                <th>Stock</th>
                                <th>Descripción</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($articles as $article)
                                <tr>
                                    <td>{{ $article->codigo }}</td>
                                    <td>{{ $article->nombre }}</td>
                                    <td>{{ $article->tipo }}</td>
                                    <td>{{ $article->precio_unitario }}</td>
                                    <td>{{ $article->precio_mayor }}</td>
                                    <td>{{ $article->precio_promedio }}</td>
                                    <td>{{ $article->stock }}</td>
                                    <td>{{ $article->descripcion }}</td>
                                    <td>
                                        <button wire:click="edit({{ $article->id }})"
                                            class="btn btn-primary btn-sm">Editar</button>
                                        <button onclick="deleteArticle({{ $article->id }})"
                                            class="btn btn-danger btn-sm">Eliminar</button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" align="center">No se encontraron artículos.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script>
        << << << < HEAD

        function deleteArticle(id) {
            if (confirm("¿Estás seguro de eliminar este registro?"))
                ===
                === =
                function deleteArticle(id) {
                    if (confirm("¿Estás seguro de eliminar este registro?"))
                        >>>
                        >>> > main
                    window.livewire.emit('deleteArticle', id);
                }
    </script>
</div>
