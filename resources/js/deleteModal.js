export default function deleteModal() {
    return {
        show: false,
        type: '',
        route: '',
        open(type, route) {
            this.show = true;
            this.type = type;
            this.route = route;
        },
        close() {
            this.show = false;
        }
    };
}