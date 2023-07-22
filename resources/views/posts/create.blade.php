<x-layouts.main>
    <x-slot:title>
        Post Yaratish
    </x-slot:title>

    <x-page-header>
        Yangi post
    </x-page-header>

    {{-- <div class="container-fluid bg-primary py-5 mb-5"> --}}
    <div class="container">
        <div class="w-60 py-4 ">
            <div class="contact-form">
                <div id="success"></div>
                <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data" >
                    @csrf

                    <div class="control-group mb-4">
                        <input type="text" class="form-control p-4" name="title" value="{{ old('title') }}" placeholder="Sarlavha" />
                        @error('title')
                          <p class="help-block text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="control-group mb-4">
                        <select name="category_id">
                            @foreach ($categories as $category )
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="control-group mb-4">
                            <label>Tags</label>
                        <select name="tags[]" multiple>
                      
                            @foreach ($tags as $tag )
                            <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                            @endforeach
                        </select>
                    </div>

                      <div class="control-group">
                            <input type="file" name="photo" class="form-control p-4" id="subject" placeholder="Rasim"/>
                            <p class="help-block text-danger"></p>
                        </div>
                    <div class="control-group mb-4">
                        <textarea class="form-control p-4" rows="6" name="short_content" placeholder="qisqacha mazmun">{{ old('short_content') }}</textarea>
                        @error('short_content')
                        <p class="help-block text-danger">{{ $message }}</p>
                      @enderror
                  </div>
                    </div>
                    <div class="control-group mb-4">
                        <textarea class="form-control p-4" rows="3" name="content" placeholder="Maqola">{{ old('content') }}</textarea>
                        @error('content')
                        <p class="help-block text-danger">{{ $message }}</p>
                      @enderror
                  </div>
                    </div>
                    <div>
                        <button class="btn btn-primary btn-block py-3 px-5" type="submit">
                            Saqlash
                        </button>
                    </div>
                </form>
            </div>
        </div>
        {{-- </div> --}}

    </div>

</x-layouts.main>
