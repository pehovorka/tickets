
@if(count($categories)>0)
    <div class="form-check checkbox-inline">    
        @foreach ($categories as $category)
            {!! Form::checkbox('category[' . $category->id . ']', $category->id, (in_array($category->id,$checked_categories->pluck('id')->toArray()) ? 1 : 0), ['id' => 'category'.$category->id]) !!}
            {!! Form::label('category'.$category->id, $category->name) !!}
            <br />
        @endforeach
    </div>
@else 
    <p>Žádné kategorie</p>
@endif


