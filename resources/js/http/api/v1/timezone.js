import Resource from '@/http/api/resource';
import request from '@/http/request';

export default class TimeZoneResource extends Resource {
  constructor() {
    super('/timezone');
  }
}
