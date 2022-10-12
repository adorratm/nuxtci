export default function({ store, redirect }) {
    if (!store.state.auth.loggedIn || store.state.auth?.user?.role_id != 1) {
      return redirect("/panel/login");
    }
}