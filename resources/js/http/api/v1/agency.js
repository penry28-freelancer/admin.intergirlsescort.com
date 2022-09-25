import Resource from '@/http/api/resource';

export default class AgencyResource extends Resource {
  constructor() {
    super('/user/agency');
  }
}
