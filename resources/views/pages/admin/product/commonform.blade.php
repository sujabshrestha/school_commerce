<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="">Title</label>
            <input type="text" name="title" value="{{ $product->title ?? '' }}" placeholder="Enter Title" autocomplete="off"
                class="form-control">
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="">Choose Category</label>
            <select name="category_id" class="form-control" id="">
                <option value="">Choose One</option>
                @if (isset($categories) && !empty($categories))
                @foreach ($categories as $category)
                    <option @if (isset($product) && $product->category_id == $category->id)
                        selected
                    @endif value="{{ $category->id }}"> {{ $category->title }} </option>
                @endforeach
                @endif
            </select>
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <label for="">Price</label>
            <input type="text" name="price" value="{{ $product->price ?? '' }}" autocomplete="off" placeholder="Enter Price" class="form-control">
        </div>
    </div>

    <div class="col-md-12 mb-2">
        <label for="">Logo</label>
        <input type="file" name="feature_img" class="form-control logo-change">

        <img class="mt-2 mb-2" src="{{ isset($product->feature_img) ? getImageUrl($product->feature_img) : "" }}" style="height: 100px; object-fit:cover;" alt="">
    </div>

    <div class="col-md-12">
        <label for="">Short Description</label>
        <textarea name="short_desc" class="summernote">{!! $product->short_desc ?? '' !!}</textarea>
    </div>
    <div class="col-md-12">
        <label for="">Description</label>
        <textarea name="desc" class="summernote">{!! $product->desc ?? '' !!}</textarea>
    </div>

</div>
