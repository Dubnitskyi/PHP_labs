<h1>Створити пост</h1>

<form action="{{ route('posts.store') }}" method="POST">
    @csrf
    <input type="text" name="title" placeholder="Заголовок">

    <textarea name="content" placeholder="Контент"></textarea>

    <button type="submit">Зберегти</button>
</form>

