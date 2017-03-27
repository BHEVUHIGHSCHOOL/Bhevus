using System;
using System.Collections.Generic;
using System.ComponentModel.DataAnnotations;
using System.ComponentModel.DataAnnotations.Schema;
using System.Linq;
using System.Web;


namespace csharpSolutions.Models
{
 
    public class StaffRegister
    {
        [Key]
        [DatabaseGenerated(DatabaseGeneratedOption.Identity)]
        public int staffID { get; set; }
        [Required]
        [Display(Name ="First Name")]
        public String name { get; set; }
        [Required]
        [Display(Name = "Last Name")]
        public String surname { get; set; }
        [Required]
        [DataType(DataType.Date)]
        [Display(Name = "D.O.B")]
        public DateTime dob { get; set; }
        [Required]
        [Display(Name = "Identity No")]
        [MaxLength(13)]
        [MinLength(13)]
        [DataType(DataType.PhoneNumber)]
        public String Idnumber { get; set; }
        [Required]
        [Display(Name = "Email Address")]
        [DataType(DataType.EmailAddress)]
        public String email { get; set; }
        [Required]
        [Display(Name = "Gender")]
        public String Gender { get; set; }
        [Required]
        [Display(Name = "Cell Contact")]
        [DataType(DataType.PhoneNumber)]
        [MaxLength(10)]
        [MinLength(10)]
        public String contact { get; set; }
        [Required]
        [Display(Name = "Position")]
        public String Position { get; set; }
        
        [Display(Name = "Phase")]
        public String Phase { get; set; }
        [Required]
        [Display(Name = "Stream")]
        public String stream { get; set; }
        [Display(Name = "Subject(s)")]
        public bool Subject { get; set; }
        [Display(Name = "Profile Picture")]
        [DataType(DataType.ImageUrl)]
        public byte[] profilepic { get; set; }
    }
}