<form>
    <input type="hidden" wire:model="id">
    <div class="form-group mb-3">
        <label for="codigo">Código:</label>
        <input type="text" class="form-control @error('codigo') is-invalid @enderror" id="codigo" placeholder="Enter Código" wire:model="codigo">
        @error('codigo') <span class="text-danger">{{ $message }}</span>@enderror
    </div>
    <div class="form-group mb-3">
        <label for="nombre">Nombre:</label>
        <input type="text" class="form-control @error('nombre') is-invalid @enderror" id="nombre" placeholder="Enter Nombre" wire:model="nombre">
        @error('nombre') <span class="text-danger">{{ $message }}</span>@enderror
    </div>
    <div class="form-group mb-3">
        <label for="tipo">Tipo:</label>
        <input type="text" class="form-control @error('tipo') is-invalid @enderror" id="tipo" placeholder="Enter Tipo" wire:model="tipo">
        @error('tipo') <span class="text-danger">{{ $message }}</span>@enderror
    </div>
    <div class="form-group mb-3">
        <label for="precio_unitario">Precio Unitario:</label>
        <input type="text" class="form-control @error('precio_unitario') is-invalid @enderror" id="precio_unitario" placeholder="Enter Precio Unitario" wire:model="precio_unitario">
        @error('precio_unitario') <span class="text-danger">{{ $message }}</span>@enderror
    </div>
    <div class="form-group mb-3">
        <label for="precio_mayor">Precio Mayor:</label>
        <input type="text" class="form-control @error('precio_mayor') is-invalid @enderror" id="precio_mayor" placeholder="Enter Precio Mayor" wire:model="precio_mayor">
        @error('precio_mayor') <span class="text-danger">{{ $message }}</span>@enderror
    </div>
    <div class="form-group mb-3">
        <label for="precio_promedio">Precio Promedio:</label>
        <input type="text" class="form-control @error('precio_promedio') is-invalid @enderror" id="precio_promedio" placeholder="Enter Precio Promedio" wire:model="precio_promedio">
        @error('precio_promedio') <span class="text-danger">{{ $message }}</span>@enderror
    </div>
    <div class="form-group mb-3">
        <label for="stock">Stock:</label>
        <input type="text" class="form-control @error('stock') is-invalid @enderror" id="stock" placeholder="Enter Stock" wire:model="stock">
        @error('stock') <span class="text-danger">{{ $message }}</span>@enderror
    </div>
    <div class="form-group mb-3">
        <label for="descripcion">Descripción:</label>
        <textarea class="form-control @error('descripcion') is-invalid @enderror" id="descripcion" placeholder="Enter Descripción" wire:model="descripcion"></textarea>
        @error('descripcion') <span class="text-danger">{{ $message }}</span>@enderror
    </div>
    <div class="d-grid gap-2">
        <button wire:click.prevent="update()" class="btn btn-success btn-block">Guardar</button>
        <button wire:click.prevent="cancel()" class="btn btn-danger">Cancelar</button>
    </div>
</form>
