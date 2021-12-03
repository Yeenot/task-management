import moment from 'moment'

export default (value, pattern) => {
    return moment(value).format(pattern);
}