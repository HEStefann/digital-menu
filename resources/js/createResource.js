export default function createResource() {
    return {
        show: false,
        value: '',
        open() {
            this.show = true;
        },
        close() {
            this.show = false;
        }
    };
}