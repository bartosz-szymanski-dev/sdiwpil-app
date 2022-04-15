class NewDocumentModel {
  constructor(
    {
      type = '',
      doctor = 0,
      patient = 0,
      medicamentName = '',
      medicamentDescription = '',
      medicamentUsageDescription = '',
      medicamentRemission = '',
    } = {},
  ) {
    this.type = type;
    this.doctor = doctor;
    this.patient = patient;
    this.medicamentName = medicamentName;
    this.medicamentDescription = medicamentDescription;
    this.medicamentUsageDescription = medicamentUsageDescription;
    this.medicamentRemission = medicamentRemission;
  }
}

export default NewDocumentModel;
