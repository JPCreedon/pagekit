<div class="js-respond">
    <h3>@trans('Leave a comment')</h3>

    <form class="uk-form" method="post" action="@url.route('@blog/default/comment', ['thread_id' => post.id])">

        @if (app.user.hasAccess('blog: post comments'))

            @if (app.user.authenticated)

                <p class="user">@trans('Logged in as %name%', ['%name%' => app.user.name])</p>

            @else

                <p class="user">@trans('You are commenting as guest.')</p>

                @set(req = config['comments.require_name_and_email'])

                <div class="uk-form-row">
                    <input type="text" name="comment[author]" placeholder="@trans('Name')@(req ? ' *')"@(req ? ' required')>
                </div>
                <div class="uk-form-row">
                    <input type="email" name="comment[email]" placeholder="@trans('E-mail')@(req ? ' *')"@(req ? ' required')>
                </div>
                <div class="uk-form-row">
                    <input type="url" name="comment[url]" placeholder="@trans('Website')">
                </div>

            @endif

            <div class="uk-form-row">
                <textarea class="uk-form-width-large" name="comment[content]" required></textarea>
            </div>

            <p>
                <input class="uk-button uk-button-primary" type="submit" value="@trans('Submit comment')" accesskey="s">
                <a class="js-cancel-reply" href="#">@trans('Cancel')</a>
            </p>

            <input type="hidden" name="comment[parent_id]" value="0">

        @elseif (app.user.authenticated)

            @trans('You are not allowed to post comments.')

        @else

            @trans('Please login to leave a comment.')

        @endif

        @token()

    </form>
</div>