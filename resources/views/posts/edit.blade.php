<x-layouts.main>
<x-slot:title>
    Postni ozgartirish
</x-slot:title>

<x-page-header>
   Podtni  Ozgartirish #{{ $post->id }}
</x-page-header>

<div class="container">
    <div class="w-60 py-4 ">
        <div class="contact-form">
            <div id="success"></div>
            <form action="{{ route('posts.update', ['post'=>$post->id]) }}" method="POST" enctype="multipart/form-data" >
                @method('PUT')
                @csrf

                <div class="control-group mb-4">
                    <input type="text" class="form-control p-4" name="title" value="{{ $post->title }}" placeholder="Sarlavha" />
                    @error('title')
                      <p class="help-block text-danger">{{ $message }}</p>
                    @enderror
                </div>
                  <div class="control-group">
                        <input type="file" name="photo" class="form-control p-4" id="subject" placeholder="Rasim"/>
                        <p class="help-block text-danger"></p>
                    </div>
                <div class="control-group mb-4">
                    <textarea class="form-control p-4" rows="6" name="short_content" placeholder="qisqacha mazmun">{{ $post->short_content }}</textarea>
                    @error('short_content')
                    <p class="help-block text-danger">{{ $message }}</p>
                  @enderror
              </div>
                </div>
                <div class="control-group mb-4">
                    <textarea class="form-control p-4" rows="3" name="content" placeholder="Maqola">{{ $post->content }}</textarea>
                    @error('content')
                    <p class="help-block text-danger">{{ $message }}</p>
                  @enderror
              </div>
                </div>
                <div class="flex">
                    <button class="btn btn-primary  py-3 px-5" type="submit">
                        Saqlash
                    </button>
                    <a href="{{ route('posts.show',['post'=>$post->id]) }}" class="btn btn-danger  py-3 px-5" >
                        Bekor qilish
                    </a>
                </div>
            </form>
        </div>
    </div>
    {{-- </div> --}}

</div>




</x-layouts.main>


