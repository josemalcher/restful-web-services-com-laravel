<div class="form-group">
    <label>Nome: </label>
    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Nome Aqui', 'required']) !!}
</div>
<div class="form-group">
    <label>Descrição:</label>
    {!! Form::textarea('description', null, ['class' => 'form-control', 'placeholder' => 'Descrição Aqui!', 'required']) !!}
</div>
<div class="form-group">
    <input type="submit" value="Enviar" class="btn btn-default">
</div>