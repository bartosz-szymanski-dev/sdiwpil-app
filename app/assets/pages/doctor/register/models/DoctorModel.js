import UserModel from '../../../../shared/models/UserModel';

class DoctorModel extends UserModel {
  constructor(
    {
      pesel = '',
    } = {},
  ) {
    super();

    this.pesel = pesel;
  }
}

export default DoctorModel;
