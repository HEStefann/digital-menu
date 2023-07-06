export default function categoryManipulation() {
    return {
        checkedCategories: [],
        isChecked(id) {
            const ids = Object.values(this.checkedCategories)
            console.log(ids)
            console.log(ids.includes(id.toString()), id.toString());
            return ids.includes(id.toString());
        }
    }
}