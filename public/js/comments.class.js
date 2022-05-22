class Comments {

    /**
     *
     * @type {string}
     */
    commentsEndpoint = 'http://localhost/comment/get';
    stylesheetUrl = 'http://localhost/public/css/comment.css';
    postFormDataUrl = 'http://localhost/comment/new';
    deleteCommentUrl = 'http://localhost/comment/delete/';

    /**
     *
     * @param postId
     * @returns {Promise<any>}
     */
    async fetchComments(postId)
    {
        const response = await fetch(this.commentsEndpoint, {
            method: 'POST',
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                postId: postId
            })
        });

        return await response.json();
    }

    /**
     *
     * @param data
     */
    getError(data)
    {
        let errors = document.getElementsByClassName('error');

        if (errors.length === 0) {
            let div = document.createElement('div');

            div.innerText = data.message;
            div.classList = 'error';

            document.getElementById('root').insertAdjacentElement('beforebegin', div);
        }
    }

    /**
     *
     * @returns {string}
     */
    generateID(length = 8)
    {
        let result = ''
            , characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz'
            , charactersLength = characters.length;

        for (let i = 0; i < length; i++) {
            result += characters.charAt(Math.floor(Math.random() * charactersLength));
        }

        return result;
    }

    deleteButtons(btns, postID)
    {
        for (let i = 0; i < btns.length; i++)
        {
            let button = btns[i]
                , commentId = button.dataset.commentId;

            button.addEventListener('click', e => {
                e.preventDefault();

                this.postDeleteAction(commentId)
                    .then(res => res.error ? this.getError(res) : this.reloadComments(postID))
            });
        }
    }

    /**
     *
     *
     * @param id
     * @returns {Promise<any>}
     */
    async postDeleteAction(id)
    {
        let data = {
            commentId: id
        }

        const response = await fetch(`${this.deleteCommentUrl + id}`, {
            method: 'POST',
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(data)
        }), json = await response.json();

        return json;
    }

    /**
     *
     * @param data
     * @param postID
     */
    drawComments(data, postID)
    {
        // List
        let list = document.createElement('ul')
            , root = document.getElementById('root');

        root.appendChild(list);

        // Create title
        let title = document.createElement('h1');

        title.classList = 'big-title comment-title';
        title.innerText = 'Comments';

        list.parentNode.insertBefore(title, list);

        // Create comments
        let values = Object.values(data)
            , keys = Object.keys(data);

        for (let i = 0; i < keys.length; i++)
        {
            let comment = values[i]
                , li = document.createElement('li');

            li.id = this.generateID();
            li.classList = 'comment';
            li.innerHTML = `<div><button class="delete-comment" data-comment-id=${comment.comment_id}><img src="http://localhost/public/img/delete_icon.svg" alt=""></button><span>${comment.created_comment}</span><br>Username: <span>${comment.username}</span><br>Full Name: ${comment.first_name + ' ' + comment.last_name}<br><br><p>${comment.comment_Content}</p></div>`;

            list.appendChild(li);
        }

        let _d = document.getElementsByClassName('delete-comment');
        this.deleteButtons(_d, postID);
    }

    /**
     * Create
     * CSS Link
     */
    callStyles()
    {
        let link = document.createElement('link')
            , root = document.getElementById('root');

        link.id = this.generateID(12);
        link.rel = 'stylesheet';
        link.href = this.stylesheetUrl;

        root.appendChild(link)
    }

    /**
     *
     * @param postID
     */
    reloadComments(postID)
    {
        let list = document.querySelector('ul')
            , title = document.querySelector('.comment-title');

        list.remove();
        title.remove();

        this.fetchComments(postID)
            .then(res => res.error ? this.getError(res) : this.drawComments(res, postID));
    }

    /**
     *
     * @param props
     */
    createForm(props) // object
    {
        let form = document.createElement('form')
            , root = document.getElementById('root');

        // Create form
        form.innerHTML = `<h1 class="big-title">${props.title}</h1><textarea name="${props.textarea.name}" placeholder="${props.textarea.placeholder}"></textarea><button type="button" class="form-btn" id="submit-form">${props.btnText}</button>`;
        root.appendChild(form);

        // AddEventListeners

        const submitBtn = document.getElementById('submit-form');
        submitBtn.addEventListener('click', (e) => {
            e.preventDefault();

            let formData = new FormData(form)
                , data = formData.get(props.textarea.name).trim();

            this.postFormData({
                submitUrl: this.postFormDataUrl,
                newCommentData: data
            })
                .then(res => {

                    if (res.error) {
                        this.getError(res);
                    }

                    if (res.success) {
                        console.log(res.message); // Get message

                        this.reloadComments(props.postId);
                    }

                });
        });

        form.onsubmit = (e) => e.preventDefault();
    }

    /**
     *
     * @param data
     * @returns {Promise<void>}
     */
    async postFormData(data)
    {
        let postData = {
            newComment: 1,
            data: data.newCommentData
        }

        const res = await fetch(data.submitUrl, {
            method: 'POST',
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(postData)
        }), json = await res.json();

        return json;
    }

}