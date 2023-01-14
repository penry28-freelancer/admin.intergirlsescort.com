import Resource from '@/http/api/resource';

export default class TimeZoneResource extends Resource {
  constructor() {
    super('/timezone');
  }
}
