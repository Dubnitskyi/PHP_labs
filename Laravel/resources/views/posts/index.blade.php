<h1>Список постів</h1>

<a href="{{ route('posts.create') }}">+ Створити новий пост</a>

<ul>
    @foreach ($posts as $post)
        <li>
            {{ $post->title }}
            <a href="{{ route('posts.edit', $post) }}">Редагувати</a>
            <form action="{{ route('posts.destroy', $post) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit">Видалити</button>
            </form>
        </li>
    @endforeach
</ul>
