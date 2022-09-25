import Resource from '@/http/api/resource';

export default class ClubResource extends Resource {
  constructor() {
    super('/user/club');
  }
}
