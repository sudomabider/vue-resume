import moment from 'moment';

export function year (time) {
  return moment(time).year();
}

export function yearMonth (time) {
  return time ? moment(time).format('YYYY-MM') : '';
}