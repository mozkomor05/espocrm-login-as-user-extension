define('login-as-user:handlers/actions/login-as-user', ['action-handler'], function (Dep) {
    return Dep.extend({
        init: function () {
            if (
                this.getUser().isAdmin() &&
                document.cookie.indexOf('login-as-user-id') === -1 &&
                this.view.model.id !== this.getUser().id &&
                (this.view.model.isRegular() || this.view.model.isAdmin() || this.view.model.isPortal())
            ) {
                this.view.showHeaderActionItem('loginAsUser');

                return;
            }

            this.view.hideHeaderActionItem('loginAsUser');
        },

        actionLoginAsUser: function () {
            document.cookie = 'login-as-user-id=' + this.view.model.id + '; SameSite=Lax; path=/';
            window.location.href = '/';
        }
    });
});
