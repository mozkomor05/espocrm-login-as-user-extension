define('login-as-user:views/site/navbar', ['views/site/navbar'], function (Dep) {
    return Dep.extend({
        getMenuDataList: function () {
            const menuDataList = Dep.prototype.getMenuDataList.call(this);

            if (document.cookie.indexOf('login-as-user-id') > -1) {
                const logoutItem = menuDataList.find(item => item.action === 'logout');

                logoutItem.action = 'returnToAccount';
                logoutItem.label = this.translate('Return to My Account');
            }

            return menuDataList;
        },

        actionReturnToAccount: function () {
            document.cookie = 'login-as-user-id=; SameSite=Lax; expires=Thu, 01 Jan 1970 00:00:01 GMT; path=/';

            this.ajaxGetRequest('User').then(() => {
                this.getRouter().navigate('#User/view/' + this.getUser().id, {trigger: true});
                window.location.reload();
            });
        },
    });
});
