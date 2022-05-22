<form action="#">
    <input type="date">
    <button type="submit">submit</button>
</form>

<br>
<hr>
<br>

<h1>Posts</h1>
<ul role="list">
    <?php foreach ($posts as $post): ?>
    <li><?=$post->title?></li>
    <?php endforeach; ?>
</ul>

<br>
<hr>
<br>

<h1>Users</h1>
<ul role="list">
    <?php foreach ($users as $user): ?>
    <li><?=$user->first_name?></li>
    <?php endforeach; ?>
</ul>


<br>
<hr>
<br>

<h1>Categories</h1>
<ul role="list">
    <?php foreach ($categories as $category): ?>
    <li><?=$category->category_name?></li>
    <?php endforeach; ?>
</ul>

<script type="text/javascript">

    window.onload = () => {
        const form = document.querySelector('form')

        form.onsubmit = (e) => {
            e.preventDefault()

            let date = document.querySelector('input')
            console.log(date.value)
        }
    }

</script>