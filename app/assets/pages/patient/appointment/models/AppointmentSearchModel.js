class AppointmentSearchModel {
  constructor(
    {
      medicalSpecialty = '',
      city = '',
      name = '',
    } = {},
  ) {
    this.medicalSpecialty = medicalSpecialty;
    this.city = city;
    this.name = name;
  }
}

export default AppointmentSearchModel;
