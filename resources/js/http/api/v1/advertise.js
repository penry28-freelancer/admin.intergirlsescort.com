import Resource from '@/http/api/resource';
import request from '@/http/request';

export default class AdvertiseResource extends Resource {
  constructor() {
    super('/utility/advertise');
  }
}
