import Resource from '@/http/api/resource';

export default class AgencyReviewResource extends Resource {
  constructor() {
    super('/support/agency-review');
  }
}
