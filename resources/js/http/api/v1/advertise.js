import Resource from '@/http/api/resource';

export default class AdvertiseResource extends Resource {
  constructor() {
    super('/utility/advertise');
  }
}
