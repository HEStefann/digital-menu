export default function imageModal() {
    return {
        show: false,
        open() {
            this.show = true;
        },
        close() {
            this.show = false;
        }
    };
}