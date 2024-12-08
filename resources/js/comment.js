export class CommentSection {
    constructor() {
        this.COMMENTSEC = document.getElementById("comment-sec");
        /*
        this.replyCommentBtns = document.querySelectorAll('.comment-reply-btn');
        this.replyCommentForm = document.querySelector('#reply-comment-modal');
        this.replyToText = this.replyCommentForm.querySelector('#replyTo');
        this.replyTextEl = this.replyCommentForm.querySelector('textarea#reply');
        this.parentIdEl = this.replyCommentForm.querySelector('input#parent_id');
        this.moreCommentBtn = document.getElementById('moreComment');
         */


        this.page = 0;
        this.hasMoreComment = true;
        this.loader = '<div>Loading...</div>'; // Replace with actual loader HTML if needed
        this.init();
    }

    init() {
        if (this.COMMENTSEC) {
            this.replyCommentBtns = document.querySelectorAll('.comment-reply-btn');
            this.replyCommentForm = document.querySelector('#reply-comment-modal');
            if( this.replyCommentForm){
                this.replyToText = this.replyCommentForm.querySelector('#replyTo');
                this.replyTextEl = this.replyCommentForm.querySelector('textarea#reply');
                this.parentIdEl = this.replyCommentForm.querySelector('input#parent_id');
            }
            this.moreCommentBtn = document.getElementById('moreComment');
            this.openModal(this.replyCommentBtns);
        }
        if (this.moreCommentBtn) {
            this.moreCommentBtn.addEventListener('click', (e) => {
                e.preventDefault();
                if (this.hasMoreComment) {
                    this.loadMoreComment(this.page);
                    this.page++;
                }
            });
        }
    }

    openModal(replyCommentBtns) {
        replyCommentBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                let id = btn.getAttribute('itemid');
                this.parentIdEl.setAttribute('value', id);
                this.replyToText.innerText = document.querySelector(`#comment-num-${id}`).innerHTML;
                this.replyTextEl.value = '';
            });
        });
    }

    loadMoreComment(page) {
        const COMMENTSEC = this.COMMENTSEC;
        const moreCommentBtn = this.moreCommentBtn;
        const text = moreCommentBtn.innerHTML;
        moreCommentBtn.innerHTML = this.loader;

        axios.get('/ajax/comments/more', {
            params: {
                page: page,
                'content-type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'commentable_type': document.getElementById('modelComment').value,
                'commentable_id': document.getElementById('uidModelComment').value,
            }
        }).then(response => {
            if (response.data.data !=='') {

                let newComment = document.createElement('div');
                newComment.innerHTML = response.data.data;
                COMMENTSEC.append(newComment);
                this.hasMoreComment = true;
                this.updateReplyButtons();
            } else {
                this.hasMoreComment = false;
                moreCommentBtn.remove();
                COMMENTSEC.append('مورد دیگری وجود ندارد');
            }
        }).catch(error => {
            console.error(error);
        }).finally(() => {
            moreCommentBtn.innerHTML = text;
        });
    }

    updateReplyButtons() {
        this.replyCommentBtns = document.querySelectorAll('.comment-reply-btn');
        this.openModal(this.replyCommentBtns);
    }
}
