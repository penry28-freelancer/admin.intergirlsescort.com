import Resource from '@/http/api/resource';
import request from '@/http/request';

export default class CityResource extends Resource {
  constructor() {
    super('/location/city');
  }
}
