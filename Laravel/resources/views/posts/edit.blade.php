<h1>Редагувати пост</h1>

<form action="{{ route('posts.update', $post) }}" method="POST">
    @csrf
    @method('PUT')
    <input type="text" name="title" value="{{ $post->title }}">
    <button type="submit">Оновити</button>
</form>
