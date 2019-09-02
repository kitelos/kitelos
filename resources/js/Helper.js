class Helper {
    constructor () {

    }

    slugify (text) {
        return text.toString().toLowerCase()
            .replace(/\s+/g, '-')
            .replace(/[^\w\-]+/g, '')
            .replace(/\-\-+/g, '-')
            .replace(/^-+/, '')
            .replace(/-+$/, '');
    }

    current_date () {
        var date = new Date();
        return date.getFullYear() + '/' + date.getMonth() + '/' + date.getDate() + ' ' + date.getHours() + ':' + date.getMinutes() + ':' + date.getSeconds()
    }

    loadParams (item, edit) {
        let params = new FormData();
        if ( edit )
            params.set('_method', 'PUT')

        for (let fieldName in item) {
            let fieldValue = item[fieldName];
            if (typeof fieldValue !== 'object') {
                params.set(fieldName, fieldValue);
            } else {
                if (fieldValue && typeof fieldValue[0] !== 'object') {
                    params.set(fieldName, fieldValue);
                } else {
                    for (let index in fieldValue) {
                        params.set(fieldName + '[' + index + ']', JSON.stringify(fieldValue[index]));
                    }
                }
            }
        }

        return params;
    }

    stateValue (state, values) {
        return state == 'enable' ? { name: 'enable', value: values[0] }
        : { name: 'disable', value: values[1] }
    }
}

export default Helper