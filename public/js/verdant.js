/* Verdant Academy Frontend Interactivity Script */
const IMG = {
  web:'https://images.unsplash.com/photo-1498050108023-c5249f4df085?auto=format&fit=crop&w=800&q=70',
  data:'https://images.unsplash.com/photo-1551288049-bebda4e38f71?auto=format&fit=crop&w=800&q=70',
  design:'https://images.unsplash.com/photo-1561070791-2526d30994b5?auto=format&fit=crop&w=800&q=70',
  business:'https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?auto=format&fit=crop&w=800&q=70',
  marketing:'https://images.unsplash.com/photo-1460925895917-afdab827c52f?auto=format&fit=crop&w=800&q=70',
  cloud:'https://images.unsplash.com/photo-1451187580459-43490279c0fa?auto=format&fit=crop&w=800&q=70',
  python:'https://images.unsplash.com/photo-1526379095098-d400fd0bf935?auto=format&fit=crop&w=800&q=70',
  ux:'https://images.unsplash.com/photo-1586717791821-3f44a563fa4c?auto=format&fit=crop&w=800&q=70',
  finance:'https://images.unsplash.com/photo-1554224155-6726b3ff858f?auto=format&fit=crop&w=800&q=70',
  hero:'https://images.unsplash.com/photo-1522202176988-66273c2fd55f?auto=format&fit=crop&w=1100&q=75',
  about:'https://images.unsplash.com/photo-1524178232363-1fb2b075b655?auto=format&fit=crop&w=1000&q=75',
  blog1:'https://images.unsplash.com/photo-1516321318423-f06f85e504b3?auto=format&fit=crop&w=800&q=70',
  blog2:'https://images.unsplash.com/photo-1488190211105-8b0e65b80b4e?auto=format&fit=crop&w=800&q=70',
  blog3:'https://images.unsplash.com/photo-1434030216411-0b793f4b4173?auto=format&fit=crop&w=800&q=70',
  team1:'https://images.unsplash.com/photo-1600880292203-757bb62b4baf?auto=format&fit=crop&w=800&q=75',
  team2:'https://images.unsplash.com/photo-1552664730-d307ca884978?auto=format&fit=crop&w=800&q=75',
  team3:'https://images.unsplash.com/photo-1531482615713-2afd69097998?auto=format&fit=crop&w=800&q=75',
  office:'https://images.unsplash.com/photo-1497366216548-37526070297c?auto=format&fit=crop&w=800&q=75',
  books:'https://images.unsplash.com/photo-1495446815901-a7297e633e8d?auto=format&fit=crop&w=1000&q=75',
  book1:'https://images.unsplash.com/photo-1544716278-ca5e3f4abd8c?auto=format&fit=crop&w=600&q=75',
  book2:'https://images.unsplash.com/photo-1512820790803-83ca734da794?auto=format&fit=crop&w=600&q=75',
  book3:'https://images.unsplash.com/photo-1543002588-bfa74002ed7e?auto=format&fit=crop&w=600&q=75',
  book4:'https://images.unsplash.com/photo-1532012197267-da84d127e765?auto=format&fit=crop&w=600&q=75',
  book5:'https://images.unsplash.com/photo-1589998059171-988d887df646?auto=format&fit=crop&w=600&q=75',
  book6:'https://images.unsplash.com/photo-1497633762265-9d179a990aa6?auto=format&fit=crop&w=600&q=75'
};
const AV = (n)=>`https://i.pravatar.cc/160?img=${n}`;

const CATEGORIES = [
  {id:'web',   name:'Web Development',      icon:'code-2',    count:58, desc:'Frontend, backend and full-stack engineering.'},
  {id:'data',  name:'Data & Analytics',     icon:'bar-chart-3', count:44, desc:'SQL, Python, visualisation and machine learning.'},
  {id:'design',name:'Product Design',       icon:'pen-tool',  count:37, desc:'UX research, interface design and design systems.'},
  {id:'business',name:'Business & Management',icon:'briefcase',count:41, desc:'Strategy, operations, finance and leadership.'},
  {id:'marketing',name:'Digital Marketing', icon:'megaphone', count:33, desc:'SEO, paid media, content and analytics.'},
  {id:'cloud', name:'Cloud & DevOps',       icon:'cloud',     count:29, desc:'AWS, Docker, Kubernetes and CI/CD pipelines.'},
  {id:'mobile',name:'Mobile Development',   icon:'smartphone',count:22, desc:'iOS, Android and cross-platform apps.'},
  {id:'career',name:'Career & Soft Skills', icon:'sparkles',  count:18, desc:'Communication, interviews and remote work.'}
];

const INSTRUCTORS = [
  {id:'i1', name:'Dr. Amara Osei',    role:'Lead Data Scientist',       img:AV(45), bio:'Former principal data scientist with 12 years across fintech and healthcare analytics.', expertise:['Python','Machine Learning','SQL'], students:18420, courses:6, rating:4.9},
  {id:'i2', name:'Marcus Feld',       role:'Full-Stack Engineer',       img:AV(12), bio:'Built payment infrastructure at scale. Teaches the patterns he uses in production every day.', expertise:['JavaScript','Node.js','PostgreSQL'], students:22130, courses:8, rating:4.8},
  {id:'i3', name:'Priya Raghunathan', role:'Product Design Director',   img:AV(47), bio:'Design lead for two unicorn startups. Specialises in research-driven interface work.', expertise:['Figma','UX Research','Design Systems'], students:14680, courses:5, rating:4.9},
  {id:'i4', name:'Jonas Lindqvist',   role:'Cloud Architect',           img:AV(33), bio:'AWS certified architect managing multi-region infrastructure for European media groups.', expertise:['AWS','Kubernetes','Terraform'], students:9270, courses:4, rating:4.7},
  {id:'i5', name:'Helena Marchetti',  role:'Growth Marketing Lead',     img:AV(26), bio:'Scaled three B2B SaaS companies from launch to series B using paid and content channels.', expertise:['SEO','Paid Media','Analytics'], students:11400, courses:5, rating:4.8},
  {id:'i6', name:'Samuel Adeyemi',    role:'Engineering Manager',       img:AV(59), bio:'Leads a platform team of 14 engineers. Teaches system design and technical leadership.', expertise:['System Design','Leadership','Go'], students:7890, courses:3, rating:4.9}
];

const COURSES = [
  {id:1,title:'The Complete Web Development Bootcamp',cat:'web',instructor:'i2',level:'Beginner',lang:'English',duration:'52h',lessons:214,rating:4.8,reviews:3412,price:89,oldPrice:189,students:18420,thumb:IMG.web,featured:true,bestseller:true,updated:'Sep 2025',
   short:'Go from zero to deploying full-stack applications with HTML, CSS, JavaScript, Node and PostgreSQL.',
   desc:'This bootcamp is the most complete web development programme we offer. You will build eleven real projects, including an e-commerce storefront, a real-time chat application and a REST API with authentication. Each module ends with a graded assignment reviewed by a mentor.',
   learn:['Build responsive interfaces with modern HTML, CSS and JavaScript','Create REST APIs with Node.js, Express and PostgreSQL','Implement authentication, sessions and secure password storage','Deploy production applications with CI/CD pipelines','Write clean, testable code using industry conventions','Debug and profile applications using browser and server tooling'],
   req:['A computer with any operating system','No prior programming experience required','Willingness to commit 8–10 hours per week'],
   audience:['Aspiring developers changing careers','Designers who want to build their own prototypes','Students preparing for junior developer interviews'],
   modules:[
     {title:'Foundations of the Web',lessons:[['How the web actually works','12:40'],['HTML structure and semantics','24:10'],['CSS layout with Flexbox and Grid','38:22'],['Responsive design principles','26:05']]},
     {title:'JavaScript in Depth',lessons:[['Variables, types and scope','19:30'],['Functions, closures and the this keyword','31:15'],['DOM manipulation and events','28:44'],['Async JavaScript and fetch','35:02']]},
     {title:'Backend with Node & Express',lessons:[['Setting up a Node project','16:20'],['Routing and middleware','27:48'],['Working with PostgreSQL','41:12'],['Authentication and sessions','38:55']]},
     {title:'Deployment & DevOps Basics',lessons:[['Environment variables and secrets','14:05'],['Deploying to a cloud host','29:33'],['CI/CD with GitHub Actions','23:17']]}
   ]},
  {id:2,title:'Data Analytics with Python & SQL',cat:'data',instructor:'i1',level:'Intermediate',lang:'English',duration:'44h',lessons:168,rating:4.9,reviews:2187,price:99,oldPrice:169,students:12340,thumb:IMG.data,featured:true,bestseller:false,updated:'Oct 2025',
   short:'Turn raw data into decisions using pandas, SQL and clear visual storytelling.',
   desc:'Learn the full analyst workflow: sourcing data, cleaning it, querying at scale and communicating findings to non-technical stakeholders. Includes four end-to-end case studies from retail, healthcare and SaaS.',
   learn:['Write analytical SQL including window functions and CTEs','Clean and reshape data with pandas','Build dashboards that answer real business questions','Apply statistical reasoning without overclaiming','Present findings to executives with confidence'],
   req:['Basic spreadsheet experience','Comfort with high-school level mathematics','No prior Python experience needed'],
   audience:['Analysts moving from spreadsheets to code','Marketing and operations professionals','Career changers targeting data roles'],
   modules:[
     {title:'SQL for Analysts',lessons:[['SELECT, WHERE and JOIN','32:10'],['Aggregations and GROUP BY','27:40'],['Window functions','35:18'],['CTEs and query structure','24:55']]},
     {title:'Python & Pandas',lessons:[['Setting up Jupyter','14:22'],['DataFrames fundamentals','36:44'],['Cleaning messy data','42:08'],['Merging and reshaping','29:31']]},
     {title:'Visualisation & Storytelling',lessons:[['Choosing the right chart','21:15'],['Matplotlib and Seaborn','33:50'],['Building an executive dashboard','39:12']]}
   ]},
  {id:3,title:'Product Design Foundations',cat:'design',instructor:'i3',level:'Beginner',lang:'English',duration:'36h',lessons:142,rating:4.9,reviews:1893,price:79,oldPrice:139,students:9860,thumb:IMG.design,featured:true,bestseller:true,updated:'Aug 2025',
   short:'Learn research, wireframing, prototyping and design systems in one structured programme.',
   desc:'A practical introduction to product design that treats design as a problem-solving discipline rather than a decoration exercise. You will complete a full case study from research brief to high-fidelity prototype.',
   learn:['Run user interviews and synthesise findings','Sketch and wireframe rapidly','Build interactive prototypes in Figma','Create and document a scalable design system','Present design work persuasively'],
   req:['A free Figma account','No design background required'],
   audience:['Aspiring product designers','Frontend developers who want design skills','Founders building their first product'],
   modules:[
     {title:'Design Thinking & Research',lessons:[['What product design really is','18:40'],['Interviewing users','29:22'],['Synthesis and affinity mapping','24:15']]},
     {title:'Interface & Interaction',lessons:[['Layout, hierarchy and spacing','33:08'],['Typography and colour systems','28:44'],['Interaction and micro-states','31:20']]},
     {title:'Design Systems & Handoff',lessons:[['Components and variants','37:12'],['Documentation that engineers read','22:36'],['Developer handoff workflow','19:48']]}
   ]},
  {id:4,title:'AWS Certified Cloud Practitioner',cat:'cloud',instructor:'i4',level:'Beginner',lang:'English',duration:'28h',lessons:118,rating:4.7,reviews:1420,price:69,oldPrice:119,students:7420,thumb:IMG.cloud,featured:false,bestseller:false,updated:'Sep 2025',
   short:'Everything you need to pass the AWS Cloud Practitioner exam and understand cloud fundamentals.',
   desc:'A focused exam-preparation course covering core AWS services, pricing models, security responsibilities and architectural best practices, with three full practice exams.',
   learn:['Explain core AWS services and their use cases','Understand the shared responsibility model','Estimate costs using the pricing calculator','Apply the Well-Architected Framework pillars','Pass the CLF-C02 exam with confidence'],
   req:['General IT literacy','No cloud experience required'],
   audience:['IT professionals starting with cloud','Managers overseeing cloud projects','Students preparing for certification'],
   modules:[
     {title:'Cloud Concepts',lessons:[['What cloud computing solves','20:14'],['Regions, zones and edge locations','17:38'],['AWS global infrastructure','22:05']]},
     {title:'Core Services',lessons:[['Compute: EC2 and Lambda','34:22'],['Storage: S3 and EBS','29:40'],['Databases: RDS and DynamoDB','31:16'],['Networking: VPC basics','26:50']]},
     {title:'Security, Pricing & Exam Prep',lessons:[['IAM and the shared responsibility model','28:33'],['Billing and cost management','21:07'],['Practice exam walkthrough','45:00']]}
   ]},
  {id:5,title:'Digital Marketing Strategy',cat:'marketing',instructor:'i5',level:'Intermediate',lang:'English',duration:'32h',lessons:126,rating:4.8,reviews:1654,price:85,oldPrice:149,students:8930,thumb:IMG.marketing,featured:false,bestseller:true,updated:'Oct 2025',
   short:'Build a full-funnel marketing plan across search, social, email and content.',
   desc:'Move beyond isolated tactics. This course teaches you to design a coherent marketing strategy, allocate budget across channels and measure what actually drives revenue.',
   learn:['Build a channel strategy grounded in unit economics','Run and optimise paid search campaigns','Create an SEO roadmap that compounds over time','Design email flows that retain customers','Attribute revenue correctly across channels'],
   req:['Some familiarity with a business or product','Access to a Google Ads sandbox account is helpful'],
   audience:['Marketing generalists moving into strategy','Founders running their own growth','Agency account managers'],
   modules:[
     {title:'Strategy Foundations',lessons:[['Positioning and messaging','26:12'],['Unit economics for marketers','31:44'],['Budget allocation models','24:18']]},
     {title:'Acquisition Channels',lessons:[['Paid search fundamentals','38:22'],['Social advertising','33:07'],['SEO and content engines','40:15']]},
     {title:'Retention & Measurement',lessons:[['Lifecycle email marketing','28:40'],['Attribution and analytics','34:26'],['Building a reporting cadence','20:33']]}
   ]},
  {id:6,title:'Python for Automation & Scripting',cat:'data',instructor:'i1',level:'Beginner',lang:'English',duration:'24h',lessons:98,rating:4.8,reviews:1122,price:59,oldPrice:99,students:11240,thumb:IMG.python,featured:false,bestseller:false,updated:'Jul 2025',
   short:'Automate repetitive work with practical Python scripts you can use the same day.',
   desc:'A hands-on course focused on solving everyday problems: file handling, spreadsheets, web scraping, APIs and scheduled tasks. Every lesson produces a script you can adapt immediately.',
   learn:['Write and run Python scripts confidently','Automate Excel and CSV workflows','Scrape structured data from websites','Connect to REST APIs and handle JSON','Schedule recurring tasks on your machine'],
   req:['A computer with internet access','No programming experience required'],
   audience:['Operations and admin professionals','Analysts tired of manual reporting','Anyone curious about programming'],
   modules:[
     {title:'Python Basics',lessons:[['Installing Python and an editor','13:20'],['Variables, loops and conditionals','28:15'],['Functions and modules','24:40']]},
     {title:'Automating Real Tasks',lessons:[['Reading and writing files','22:11'],['Excel and CSV automation','31:36'],['Web scraping with requests','35:48'],['Working with JSON APIs','27:55']]},
     {title:'Scheduling & Packaging',lessons:[['Task scheduling','18:24'],['Error handling and logging','23:09'],['Packaging scripts for others','19:42']]}
   ]},
  {id:7,title:'Advanced React & TypeScript',cat:'web',instructor:'i2',level:'Advanced',lang:'English',duration:'38h',lessons:152,rating:4.9,reviews:1418,price:109,oldPrice:199,students:6240,thumb:IMG.ux,featured:false,bestseller:false,updated:'Oct 2025',
   short:'Master advanced patterns, performance and type-safe architecture in React applications.',
   desc:'For developers already comfortable with React basics. Covers compound components, render optimisation, state machines, testing strategy and building a design-system-driven component library.',
   learn:['Design reusable component APIs','Optimise rendering with memoisation and profiling','Model complex state with reducers and state machines','Write meaningful tests with Testing Library','Ship type-safe applications end to end'],
   req:['Solid JavaScript fundamentals','Prior experience building React apps','Familiarity with npm and bundlers'],
   audience:['Mid-level frontend developers','Engineers joining a design-system team','Technical leads setting frontend standards'],
   modules:[
     {title:'Component Architecture',lessons:[['Compound components','32:18'],['Render props and hooks patterns','29:44'],['Composition over configuration','26:07']]},
     {title:'Performance',lessons:[['Profiling React apps','34:52'],['Memoisation done right','28:16'],['Code splitting and lazy loading','24:38']]},
     {title:'Testing & Type Safety',lessons:[['Testing Library fundamentals','36:20'],['Testing hooks and context','30:11'],['Advanced TypeScript generics','41:05']]}
   ]},
  {id:8,title:'Financial Modelling for Managers',cat:'business',instructor:'i6',level:'Intermediate',lang:'English',duration:'22h',lessons:84,rating:4.7,reviews:742,price:95,oldPrice:159,students:4180,thumb:IMG.finance,featured:false,bestseller:false,updated:'Jun 2025',
   short:'Build reliable operating models and make confident budget decisions.',
   desc:'A practical finance course for managers without a finance background. You will build a three-statement operating model from scratch and use it to evaluate real business decisions.',
   learn:['Read and interpret the three financial statements','Build a driver-based operating model','Run scenario and sensitivity analysis','Evaluate investment decisions with NPV and IRR','Present financial plans to leadership'],
   req:['Comfort with spreadsheets','No accounting background required'],
   audience:['Managers with budget responsibility','Founders preparing for fundraising','Consultants building client models'],
   modules:[
     {title:'Financial Statements',lessons:[['The income statement','24:30'],['The balance sheet','27:15'],['Cash flow explained','22:48']]},
     {title:'Building the Model',lessons:[['Driver-based forecasting','35:20'],['Working capital and capex','29:40'],['Three-statement linking','38:12']]},
     {title:'Decision Making',lessons:[['Scenario analysis','26:33'],['NPV and IRR','31:07'],['Presenting to the board','19:55']]}
   ]},
  {id:9,title:'UX Research Methods',cat:'design',instructor:'i3',level:'Intermediate',lang:'English',duration:'26h',lessons:104,rating:4.8,reviews:964,price:89,oldPrice:149,students:5320,thumb:IMG.business,featured:false,bestseller:false,updated:'Aug 2025',
   short:'Plan, run and communicate user research that actually influences product decisions.',
   desc:'Learn the research methods that fit real deadlines: usability testing, diary studies, surveys and analytics triangulation. Includes templates for recruiting, scripts and stakeholder readouts.',
   learn:['Choose the right method for the question','Write discussion guides that avoid bias','Moderate usability sessions confidently','Analyse qualitative data systematically','Turn findings into prioritised recommendations'],
   req:['Some product or design experience helpful','No statistics background required'],
   audience:['Designers adding research skills','Product managers validating decisions','Researchers formalising their practice'],
   modules:[
     {title:'Research Planning',lessons:[['Framing research questions','22:18'],['Method selection','26:44'],['Recruiting participants','19:30']]},
     {title:'Running Sessions',lessons:[['Writing discussion guides','28:12'],['Moderating usability tests','36:40'],['Avoiding leading questions','21:25']]},
     {title:'Synthesis & Impact',lessons:[['Coding qualitative data','33:18'],['Building insight statements','24:50'],['Influencing stakeholders','27:36']]}
   ]}
];

/* ---------- BOOKS (new data) ---------- */
const BOOKS = [
  {id:'b1',title:'The Pragmatic Programmer\'s Workbook',author:'Marcus Feld',cat:'Programming',format:'Paperback',price:34,oldPrice:52,cover:IMG.book1,rating:4.8,reviews:412,pages:368,isbn:'978-1-2345-6789-0',published:'Aug 2025',badge:'New',
   desc:'A companion workbook to the classic bestseller, with 40 guided exercises that build real software from the first chapter.'},
  {id:'b2',title:'SQL Patterns for Analysts',author:'Dr. Amara Osei',cat:'Data',format:'Hardcover',price:42,oldPrice:68,cover:IMG.book2,rating:4.9,reviews:287,pages:412,isbn:'978-1-2345-6790-6',published:'Jun 2025',badge:'Bestseller',
   desc:'Thirty real-world query patterns every analyst should know, explained with clear diagrams and worked examples.'},
  {id:'b3',title:'Design Systems in Practice',author:'Priya Raghunathan',cat:'Design',format:'Paperback',price:38,oldPrice:59,cover:IMG.book3,rating:4.9,reviews:198,pages:344,isbn:'978-1-2345-6791-3',published:'Apr 2025',badge:null,
   desc:'How to build, document and maintain a design system that engineers actually use — from tokens to governance.'},
  {id:'b4',title:'Cloud Architecture Field Guide',author:'Jonas Lindqvist',cat:'Cloud',format:'Paperback',price:44,oldPrice:72,cover:IMG.book4,rating:4.7,reviews:156,pages:388,isbn:'978-1-2345-6792-0',published:'Mar 2025',badge:null,
   desc:'A practical reference for designing resilient, cost-effective cloud systems on AWS and beyond.'},
  {id:'b5',title:'Growth Marketing Playbook',author:'Helena Marchetti',cat:'Marketing',format:'eBook',price:24,oldPrice:39,cover:IMG.book5,rating:4.8,reviews:224,pages:296,isbn:'978-1-2345-6793-7',published:'Sep 2025',badge:'eBook',
   desc:'Twelve chapters that walk through the exact channel strategies used to scale three B2B SaaS companies.'},
  {id:'b6',title:'Leadership for Engineers',author:'Samuel Adeyemi',cat:'Career',format:'Hardcover',price:36,oldPrice:56,cover:IMG.book6,rating:4.8,reviews:143,pages:308,isbn:'978-1-2345-6794-4',published:'Jul 2025',badge:null,
   desc:'A field guide for engineers moving into management, with practical frameworks for one-on-ones, feedback and strategy.'}
];

/* ---------- TEAM (new data) ---------- */
const TEAM_LEADERS = [
  {id:'t1',name:'Eleanor Whitfield',role:'Co-founder & CEO',img:AV(48),bio:'Former VP of Learning at a global ed-tech company. Founded Verdant to make structured professional education genuinely completable.',social:true},
  {id:'t2',name:'Rahul Anand',role:'Co-founder & CTO',img:AV(14),bio:'Built learning platforms used by 4 million students. Leads the product and engineering organisation at Verdant.',social:true},
  {id:'t3',name:'Beatriz Castellanos',role:'Chief Academic Officer',img:AV(41),bio:'Designed curricula for three accredited universities. Ensures every Verdant programme meets real industry standards.',social:true},
  {id:'t4',name:'Tobias Keller',role:'Chief Operating Officer',img:AV(52),bio:'Fifteen years running operations at high-growth education businesses across Europe and North America.',social:true}
];

const TEAM_SUPPORT = [
  {name:'Naomi Clarke',role:'Head of Student Support',img:AV(49),loc:'London'},
  {name:'Kwame Boateng',role:'Director of Instructor Success',img:AV(61),loc:'Accra'},
  {name:'Sofia Novak',role:'Head of Curriculum',img:AV(27),loc:'Warsaw'},
  {name:'David Kim',role:'Engineering Manager, Platform',img:AV(36),loc:'Seoul'},
  {name:'Amelia Hart',role:'Head of Marketing',img:AV(23),loc:'London'},
  {name:'Yusuf Demir',role:'Head of Corporate Partnerships',img:AV(54),loc:'Istanbul'},
  {name:'Lucia Rossi',role:'Learning Experience Designer',img:AV(30),loc:'Milan'},
  {name:'Ethan Brooks',role:'Data & Analytics Lead',img:AV(65),loc:'Toronto'}
];

const TEAM_VALUES = [
  {n:'01',t:'Teach only what we practise',d:'Every instructor at Verdant still works in their field. We teach what we use daily, not what we read about.'},
  {n:'02',t:'Pace for real life',d:'Lessons are short, milestones are weekly, and completion is the measure we optimise for — not enrolment.'},
  {n:'03',t:'Give honest feedback',d:'Mentors tell students what is not working as clearly as what is. That honesty is why our completion rate is 4× the industry average.'},
  {n:'04',t:'Publish outcomes openly',d:'Pricing, completion rates and career outcomes are public. If we cannot measure it, we do not claim it.'}
];

const TEAM_OFFICES = [
  {city:'London',country:'United Kingdom',addr:'42 Alder House, Kingsway<br>London WC2B 6AN',team:18,icon:'building-2'},
  {city:'Berlin',country:'Germany',addr:'Friedrichstraße 68<br>10117 Berlin',team:9,icon:'building-2'},
  {city:'Toronto',country:'Canada',addr:'120 Adelaide Street West<br>Toronto, ON M5H 1T1',team:6,icon:'building-2'},
  {city:'Remote',country:'Worldwide',addr:'Distributed across 14 countries<br>Supporting students 24/5',team:31,icon:'globe-2'}
];

const STUDENTS = [
  {id:'s1',name:'Elena Petrova',email:'elena.petrova@example.com',img:AV(20),joined:'12 Jan 2025',courses:4,progress:72,status:'Active',spent:348},
  {id:'s2',name:'Daniel Okonkwo',email:'daniel.okonkwo@example.com',img:AV(15),joined:'03 Feb 2025',courses:2,progress:45,status:'Active',spent:168},
  {id:'s3',name:'Sofia Lindberg',email:'sofia.lindberg@example.com',img:AV(32),joined:'22 Feb 2025',courses:6,progress:91,status:'Active',spent:512},
  {id:'s4',name:'Rahul Mehta',email:'rahul.mehta@example.com',img:AV(51),joined:'08 Mar 2025',courses:1,progress:12,status:'Inactive',spent:89},
  {id:'s5',name:'Claire Dubois',email:'claire.dubois@example.com',img:AV(24),joined:'17 Apr 2025',courses:3,progress:63,status:'Active',spent:263},
  {id:'s6',name:'Tomasz Kowalski',email:'tomasz.kowalski@example.com',img:AV(60),joined:'29 May 2025',courses:5,progress:80,status:'Active',spent:441},
  {id:'s7',name:'Aisha Rahman',email:'aisha.rahman@example.com',img:AV(44),joined:'02 Jul 2025',courses:2,progress:28,status:'Pending',spent:158},
  {id:'s8',name:'Marco Bianchi',email:'marco.bianchi@example.com',img:AV(11),joined:'19 Aug 2025',courses:3,progress:54,status:'Active',spent:247}
];

const ENROLLMENTS = [
  {id:'e1',student:'s1',course:1,date:'14 Jan 2025',progress:86,status:'Active',amount:89},
  {id:'e2',student:'s3',course:2,date:'25 Feb 2025',progress:94,status:'Completed',amount:99},
  {id:'e3',student:'s2',course:3,date:'06 Feb 2025',progress:41,status:'Active',amount:79},
  {id:'e4',student:'s5',course:5,date:'19 Apr 2025',progress:67,status:'Active',amount:85},
  {id:'e5',student:'s6',course:1,date:'31 May 2025',progress:78,status:'Active',amount:89},
  {id:'e6',student:'s4',course:4,date:'10 Mar 2025',progress:9,status:'Refunded',amount:0},
  {id:'e7',student:'s7',course:6,date:'04 Jul 2025',progress:22,status:'Active',amount:59},
  {id:'e8',student:'s8',course:7,date:'21 Aug 2025',progress:49,status:'Active',amount:109},
  {id:'e9',student:'s1',course:2,date:'16 Jan 2025',progress:100,status:'Completed',amount:99},
  {id:'e10',student:'s3',course:9,date:'27 Feb 2025',progress:88,status:'Active',amount:89}
];

const REVIEWS = [
  {id:'r1',student:'s1',course:1,rating:5,text:'By far the most structured course I have taken. The mentor feedback on my final project was genuinely useful.',date:'18 Sep 2025',status:'Approved'},
  {id:'r2',student:'s3',course:2,rating:5,text:'The SQL module alone was worth the price. I use window functions at work every week now.',date:'04 Sep 2025',status:'Approved'},
  {id:'r3',student:'s5',course:5,rating:4,text:'Excellent strategic content. I would have liked more depth on TikTok advertising, but the fundamentals are solid.',date:'22 Aug 2025',status:'Approved'},
  {id:'r4',student:'s2',course:3,rating:5,text:'I came in with zero design experience and finished with a portfolio piece I am proud of.',date:'11 Aug 2025',status:'Approved'},
  {id:'r5',student:'s8',course:7,rating:4,text:'Very advanced and dense. Not for beginners, but exactly what I needed for my team lead role.',date:'02 Aug 2025',status:'Pending'},
  {id:'r6',student:'s6',course:1,rating:5,text:'The deployment section finally made CI/CD click for me after two years of avoiding it.',date:'28 Jul 2025',status:'Approved'}
];

const POSTS = [
  {id:'p1',title:'How to Choose Your First Programming Language in 2025',cat:'Career',author:'i2',date:'02 Oct 2025',read:'7 min',img:IMG.blog1,excerpt:'The honest answer depends less on the language and more on what you want to build in the next six months.',status:'Published'},
  {id:'p2',title:'A Practical Guide to Studying While Working Full Time',cat:'Learning',author:'i3',date:'24 Sep 2025',read:'9 min',img:IMG.blog2,excerpt:'Four scheduling patterns our students use to consistently complete 8 hours of study per week.',status:'Published'},
  {id:'p3',title:'What Hiring Managers Actually Look For in a Data Portfolio',cat:'Data',author:'i1',date:'15 Sep 2025',read:'6 min',img:IMG.blog3,excerpt:'We asked 40 hiring managers to review anonymous portfolios. The results were remarkably consistent.',status:'Published'},
  {id:'p4',title:'Design Systems: When to Build One and When to Wait',cat:'Design',author:'i3',date:'03 Sep 2025',read:'8 min',img:IMG.design,excerpt:'Building a design system too early is a common and expensive mistake. Here is how to tell.',status:'Draft'}
];

const FAQS = [
  {q:'Do I get a certificate when I finish a course?',a:'Yes. Every course includes a verifiable certificate of completion. Once you finish all lessons and pass the final assessment, your certificate is generated automatically with a unique verification ID you can share on LinkedIn or with employers.',cat:'Certificates'},
  {q:'How long do I have access to a course?',a:'You get lifetime access to any course you enrol in, including all future updates, new lessons and downloadable resources. There is no recurring fee for course access.',cat:'Access'},
  {q:'Can I get a refund if the course is not right for me?',a:'We offer a 30-day refund policy. If you have completed less than 30% of the course and it is within 30 days of purchase, contact support and we will process a full refund, no questions asked.',cat:'Payments'},
  {q:'Are the courses self-paced or scheduled?',a:'All lessons are self-paced and available immediately. However, each course includes optional weekly live mentor sessions and a suggested milestone schedule to help you stay on track.',cat:'Learning'},
  {q:'Do I need to install anything special?',a:'It depends on the course. Programming courses require a code editor (free) and a terminal. Design courses need a free Figma account. Every course lists its requirements clearly on the detail page before you enrol.',cat:'Technical'},
  {q:'Is there support if I get stuck?',a:'Yes. Every course has a discussion forum monitored by instructors and teaching assistants, with a response time of under 24 hours on weekdays. Mentors also hold weekly office hours.',cat:'Support'}
];

const BOOK_FAQS = [
  {q:'Do you ship internationally?',a:'Yes. We ship paperback and hardcover titles to 42 countries. Standard shipping is free on orders over $50; express delivery is available at checkout. eBooks are delivered instantly by email.',cat:'Shipping'},
  {q:'Are the books available as eBooks?',a:'Every title is available as a DRM-free PDF and ePub. When you buy the eBook format you get instant download links for both, plus access to any future editions at no extra cost.',cat:'Formats'},
  {q:'Do the books come with course access?',a:'Some titles include a companion code for a related course or workbook. Look for the "Includes course access" badge on the book page — it means you get free access to a matching module or short programme.',cat:'Bundles'},
  {q:'What is your return policy for books?',a:'Physical books can be returned within 30 days in original condition for a full refund. eBooks are non-refundable once downloaded, but we will happily exchange a title if you bought the wrong one.',cat:'Returns'},
  {q:'Can I buy a bundle of related books?',a:'Yes. Our collection bundles combine three or four related titles at 25–35% off the individual prices. Bundles are listed at the top of this page and are updated every quarter.',cat:'Bundles'},
  {q:'Are the books used in your courses?',a:'Many are. The instructor who wrote each book uses it as the primary reference for one of their courses. You will find a link to the related course on every book page.',cat:'Courses'}
];

const MESSAGES = [
  {id:'m1',name:'Karen Whitfield',email:'k.whitfield@northgate.co',subject:'Corporate training enquiry',date:'08 Oct 2025',status:'Unread',body:'We are looking to enrol 25 staff members on the data analytics programme. Could you share your corporate pricing and invoicing options?'},
  {id:'m2',name:'Ahmed Hassan',email:'ahmed.h@example.com',subject:'Certificate verification',date:'07 Oct 2025',status:'Read',body:'I completed the web development bootcamp in August. My employer needs to verify my certificate — how do they do that?'},
  {id:'m3',name:'Lucia Ferreira',email:'lucia.f@example.com',subject:'Payment issue',date:'05 Oct 2025',status:'Unread',body:'My card was charged twice for the UX Research course. Could you check and refund the duplicate?'},
  {id:'m4',name:'Peter Nowak',email:'p.nowak@example.com',subject:'Partnership proposal',date:'01 Oct 2025',status:'Replied',body:'We run a coding bootcamp in Kraków and would like to discuss a content licensing partnership.'}
];

const SUBSCRIBERS = [
  {id:'n1',email:'julia.mendes@example.com',date:'08 Oct 2025',source:'Footer form',status:'Subscribed'},
  {id:'n2',email:'ryan.oconnell@example.com',date:'06 Oct 2025',source:'Course page',status:'Subscribed'},
  {id:'n3',email:'mei.tanaka@example.com',date:'04 Oct 2025',source:'Blog article',status:'Subscribed'},
  {id:'n4',email:'omar.khalil@example.com',date:'01 Oct 2025',source:'Footer form',status:'Unsubscribed'},
  {id:'n5',email:'nadia.petrov@example.com',date:'28 Sep 2025',source:'Newsletter popup',status:'Subscribed'}
];

const CERTIFICATES = [
  {id:'c1',student:'s3',course:2,issued:'26 Sep 2025',grade:'Distinction',serial:'VA-2025-002184'},
  {id:'c2',student:'s1',course:2,issued:'14 Sep 2025',grade:'Merit',serial:'VA-2025-002031'},
  {id:'c3',student:'s6',course:5,issued:'02 Sep 2025',grade:'Distinction',serial:'VA-2025-001897'},
  {id:'c4',student:'s5',course:3,issued:'19 Aug 2025',grade:'Pass',serial:'VA-2025-001744'}
];

const NOTIFICATIONS = [
  {id:'nt1',title:'New course launch: Advanced React & TypeScript',audience:'All students',date:'08 Oct 2025',status:'Sent'},
  {id:'nt2',title:'Scheduled maintenance — Sunday 02:00 UTC',audience:'All users',date:'05 Oct 2025',status:'Sent'},
  {id:'nt3',title:'Scholarship applications now open',audience:'Subscribers',date:'01 Oct 2025',status:'Draft'}
];

const PAGES = [
  {id:'pg1',title:'About Us',slug:'/about',updated:'12 Sep 2025',status:'Published'},
  {id:'pg2',title:'Contact Us',slug:'/contact',updated:'04 Aug 2025',status:'Published'},
  {id:'pg3',title:'Privacy Policy',slug:'/privacy',updated:'22 Jun 2025',status:'Published'},
  {id:'pg4',title:'Terms & Conditions',slug:'/terms',updated:'22 Jun 2025',status:'Published'},
  {id:'pg5',title:'Disclaimer',slug:'/disclaimer',updated:'22 Jun 2025',status:'Published'},
  {id:'pg6',title:'Cookie Policy',slug:'/cookies',updated:'22 Jun 2025',status:'Published'}
];

const ENROLL_CHART = [
  {m:'Nov',v:412},{m:'Dec',v:368},{m:'Jan',v:684},{m:'Feb',v:731},
  {m:'Mar',v:812},{m:'Apr',v:769},{m:'May',v:894},{m:'Jun',v:842},
  {m:'Jul',v:1032},{m:'Aug',v:968},{m:'Sep',v:1184},{m:'Oct',v:1268}
];

/* ============================================================
   STATE + HELPERS
   ============================================================ */
const Store = {
  get(k,d){ try{ const v = localStorage.getItem('verdant_'+k); return v===null?d:JSON.parse(v); }catch(e){ return d; } },
  set(k,v){ try{ localStorage.setItem('verdant_'+k, JSON.stringify(v)); }catch(e){} }
};

const State = {
  wishlist: Store.get('wishlist', [3,5]),
  enrolled: Store.get('enrolled', [1,2]),
  sidebarOpen: false,
  courseFilters: { q:'', cat:'all', level:'all', price:'all', sort:'popular', page:1, per:6 },
  bookFilters: { q:'', cat:'all', format:'all', sort:'popular' },
  adminFilters: {},
  adminPage: 1
};

const $  = (s,r=document)=>r.querySelector(s);
const $$ = (s,r=document)=>Array.from(r.querySelectorAll(s));
const esc = (s)=> String(s==null?'':s).replace(/[&<>"']/g, c=>({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;'}[c]));
const courseById = id => COURSES.find(c=>String(c.id)===String(id));
const instById   = id => INSTRUCTORS.find(i=>i.id===id) || {name:'Unassigned',role:'—',img:AV(1),id:null};
const catById    = id => CATEGORIES.find(c=>c.id===id) || {name:'Uncategorised',id:null};
const studentById= id => STUDENTS.find(s=>s.id===id) || {name:'Unknown',img:AV(1),id:null};
const bookById   = id => BOOKS.find(b=>b.id===id);
const money = n => '$'+Number(n).toFixed(0);
const icons = () => { try{ window.lucide && lucide.createIcons(); }catch(e){} };

function stars(rating){
  const full = Math.round(rating);
  let out = '<span class="stars">';
  for(let i=0;i<5;i++) out += `<i data-lucide="star" style="${i<full?'':'opacity:.25'}"></i>`;
  return out + '</span>';
}

function toast(title, sub, type){
  const root = $('#toastRoot');
  const el = document.createElement('div');
  el.className = 'toast ' + (type||'');
  const ic = type==='err' ? 'alert-circle' : type==='gold' ? 'sparkles' : 'check-circle-2';
  el.innerHTML = `<i data-lucide="${ic}"></i><div><div class="t-title">${esc(title)}</div>${sub?`<div class="t-sub">${esc(sub)}</div>`:''}</div>`;
  root.appendChild(el); icons();
  setTimeout(()=>{ el.style.transition='opacity .3s,transform .3s'; el.style.opacity='0'; el.style.transform='translateX(24px)'; setTimeout(()=>el.remove(),300); }, 3600);
}

function openModal(title, body, foot){
  const root = $('#modalRoot');
  root.innerHTML = `<div class="modal" role="dialog" aria-modal="true" aria-label="${esc(title)}">
    <div class="modal-head"><h3>${esc(title)}</h3><button class="close" data-action="close-modal" aria-label="Close"><i data-lucide="x"></i></button></div>
    <div class="modal-body">${body}</div>
    ${foot?`<div class="modal-foot">${foot}</div>`:''}
  </div>`;
  root.classList.add('show'); document.body.style.overflow='hidden'; icons();
}
function closeModal(){ const r=$('#modalRoot'); r.classList.remove('show'); r.innerHTML=''; document.body.style.overflow=''; }



function applyResponsiveGrids(){
  const wide = window.innerWidth;
  ['student-grid','admin-grid','settings-grid','curr-grid'].forEach(id=>{
    const el = document.getElementById(id);
    if(!el) return;
    if(id==='student-grid') el.style.gridTemplateColumns = wide < 980 ? '1fr' : '1.5fr 1fr';
    if(id==='admin-grid')   el.style.gridTemplateColumns = wide < 980 ? '1fr' : '1.6fr 1fr';
    if(id==='settings-grid')el.style.gridTemplateColumns = wide < 980 ? '1fr' : '1fr 1fr';
    if(id==='curr-grid')    el.style.gridTemplateColumns = wide < 980 ? '1fr' : '1fr 340px';
  });
  const heroGrid = document.querySelector('.grid.g2');
  if(heroGrid && !heroGrid.dataset.preserve){
    heroGrid.style.gridTemplateColumns = wide < 900 ? '1fr' : '1fr 1fr';
  }
}
window.addEventListener('resize', ()=>{ applyResponsiveGrids(); });

function runCounters(){
  $$('[data-count]').forEach(el=>{
    const target = parseInt(el.dataset.count, 10);
    if(isNaN(target)) return;
    const dur = 1100, start = performance.now();
    function tick(now){
      const p = Math.min((now-start)/dur, 1);
      const eased = 1 - Math.pow(1-p, 3);
      el.textContent = Math.floor(target*eased).toLocaleString();
      if(p < 1) requestAnimationFrame(tick);
      else el.textContent = target.toLocaleString();
    }
    requestAnimationFrame(tick);
  });
}

/* ============================================================
   EVENT DELEGATION
   ============================================================ */
document.addEventListener('click', (e)=>{
  const el = e.target.closest('[data-action]');
  if(!el) return;
  const action = el.dataset.action;

  if(action === 'toggle-nav'){
    const nav = $('#mainNav');
    if(nav){ nav.classList.toggle('open'); el.setAttribute('aria-expanded', nav.classList.contains('open')); }
    return;
  }
  if(action === 'toggle-sidebar'){
    const sb = $('#sidebar'), sc = $('#scrim');
    if(sb){ sb.classList.toggle('open'); sc && sc.classList.toggle('show', sb.classList.contains('open')); }
    return;
  }
  if(action === 'close-sidebar'){
    const sb = $('#sidebar'), sc = $('#scrim');
    sb && sb.classList.remove('open'); sc && sc.classList.remove('show');
    return;
  }
  if(action === 'go'){ location.hash = el.dataset.href || '#/'; return; }

  if(action === 'accordion'){
    const item = el.closest('.accordion-item');
    const open = item.classList.toggle('open');
    el.setAttribute('aria-expanded', open);
    return;
  }
  if(action === 'module'){
    const mod = el.closest('.curriculum-module');
    const open = mod.classList.toggle('open');
    el.setAttribute('aria-expanded', open);
    return;
  }
  if(action === 'tab'){
    const tab = el.dataset.tab;
    const scope = el.closest('.tabs');
    if(scope){ scope.querySelectorAll('.tab-btn').forEach(b=>b.classList.remove('active')); el.classList.add('active'); }
    document.querySelectorAll('.tab-panel').forEach(p=>p.classList.remove('active'));
    const target = document.getElementById('tab-' + tab);
    if(target) target.classList.add('active');
    return;
  }

  if(action === 'wishlist'){
    const id = Number(el.dataset.id);
    const i = State.wishlist.indexOf(id);
    if(i > -1){ State.wishlist.splice(i,1); toast('Removed from wishlist','You can add it back at any time.','gold'); }
    else { State.wishlist.push(id); toast('Saved to wishlist','Find it in your student dashboard.'); }
    Store.set('wishlist', State.wishlist);
    render();
    return;
  }

  if(action === 'enroll'){
    const id = el.dataset.id;
    if(id === 'path'){ toast('Path enrolment started','This demo does not process payments.','gold'); return; }
    const num = Number(id);
    if(!State.enrolled.includes(num)){
      State.enrolled.push(num);
      Store.set('enrolled', State.enrolled);
      toast('Enrolled successfully','Open your dashboard to start learning.');
      render();
    } else { location.hash = '#/student/courses'; }
    return;
  }

  if(action === 'quick-cat'){
    const cat = el.dataset.cat;
    State.courseFilters.cat = State.courseFilters.cat === cat ? 'all' : cat;
    State.courseFilters.page = 1;
    render();
    return;
  }
  if(action === 'clear-filters'){
    State.courseFilters = {q:'',cat:'all',level:'all',price:'all',sort:'popular',page:1,per:6};
    render();
    toast('Filters cleared','Showing all 216 courses.');
    return;
  }
  if(action === 'load-more'){
    State.courseFilters.page += 1;
    render();
    const anchor = document.querySelector('.grid.g3');
    if(anchor) anchor.scrollIntoView({behavior:'smooth', block:'start'});
    return;
  }

  /* Book filters & actions */
  if(action === 'quick-book-cat'){
    const cat = el.dataset.cat;
    State.bookFilters.cat = State.bookFilters.cat === cat ? 'all' : cat;
    render();
    return;
  }
  if(action === 'clear-book-filters'){
    State.bookFilters = {q:'',cat:'all',format:'all',sort:'popular'};
    render();
    toast('Filters cleared','Showing all books.');
    return;
  }
  if(action === 'buy-book'){
    const b = bookById(el.dataset.id);
    if(!b) return;
    openModal('Confirm purchase', `
      <div style="display:flex;gap:18px;align-items:flex-start;margin-bottom:22px">
        <div style="width:90px;flex:none;border-radius:8px;overflow:hidden;box-shadow:var(--shadow-md)">
          <img src="${b.cover}" alt="" style="width:100%;aspect-ratio:3/4;object-fit:cover" onerror="this.style.display='none'">
        </div>
        <div style="flex:1">
          <div style="font-size:11.6px;font-weight:700;letter-spacing:.11em;text-transform:uppercase;color:var(--mustard-700)">${esc(b.cat)} · ${esc(b.format)}</div>
          <div style="font-family:var(--font-display);font-size:1.15rem;font-weight:600;color:var(--wine-900);margin-top:6px;line-height:1.3">${esc(b.title)}</div>
          <div class="small muted" style="margin-top:4px">by ${esc(b.author)}</div>
          <div style="display:flex;align-items:baseline;gap:10px;margin-top:14px">
            <span class="price" style="font-size:1.5rem">${money(b.price)}</span>
            <s class="muted" style="font-size:13px">${money(b.oldPrice)}</s>
          </div>
        </div>
      </div>
      <div class="info-row"><span class="k"><i data-lucide="package"></i>Format</span><span class="v">${esc(b.format)}</span></div>
      <div class="info-row"><span class="k"><i data-lucide="book"></i>Pages</span><span class="v">${b.pages}</span></div>
      <div class="info-row"><span class="k"><i data-lucide="hash"></i>ISBN</span><span class="v" style="font-family:ui-monospace,Menlo,monospace;font-size:12.6px">${esc(b.isbn)}</span></div>
      <div class="info-row"><span class="k"><i data-lucide="truck"></i>Shipping</span><span class="v">Free over $50</span></div>
      <div class="notice" style="margin-top:18px;font-size:12.8px">
        <i data-lucide="shield-check"></i>
        <span>30-day returns on physical books. eBooks are non-refundable once downloaded.</span>
      </div>
    `, `
      <button class="btn btn-ghost" data-action="close-modal">Cancel</button>
      <button class="btn btn-primary" data-action="confirm-book" data-id="${b.id}"><i data-lucide="shopping-bag"></i> Confirm purchase</button>
    `);
    return;
  }
  if(action === 'confirm-book'){
    const b = bookById(el.dataset.id);
    closeModal();
    toast('Order placed','"' + (b ? b.title : 'Book') + '" has been added to your orders.','gold');
    return;
  }
  if(action === 'view-book'){
    const b = bookById(el.dataset.id);
    if(!b) return;
    openModal(b.title, `
      <div style="display:flex;gap:20px;align-items:flex-start;margin-bottom:22px;flex-wrap:wrap">
        <div style="width:120px;flex:none;border-radius:10px;overflow:hidden;box-shadow:var(--shadow-md)">
          <img src="${b.cover}" alt="" style="width:100%;aspect-ratio:3/4;object-fit:cover" onerror="this.style.display='none'">
        </div>
        <div style="flex:1;min-width:220px">
          <div style="font-size:11.6px;font-weight:700;letter-spacing:.11em;text-transform:uppercase;color:var(--mustard-700)">${esc(b.cat)}</div>
          <div style="font-family:var(--font-display);font-size:1.3rem;font-weight:600;color:var(--wine-900);margin-top:8px;line-height:1.3">${esc(b.title)}</div>
          <div class="small muted" style="margin-top:6px">by ${esc(b.author)}</div>
          <div style="display:flex;align-items:center;gap:10px;margin-top:12px">${stars(b.rating)} <b style="font-size:13.4px">${b.rating}</b> <span class="small muted">(${b.reviews} reviews)</span></div>
          <div style="display:flex;align-items:baseline;gap:10px;margin-top:14px">
            <span class="price" style="font-size:1.6rem">${money(b.price)}</span>
            <s class="muted" style="font-size:13px">${money(b.oldPrice)}</s>
          </div>
        </div>
      </div>
      <p style="font-size:14.6px;line-height:1.72;color:var(--ink-500);margin-bottom:20px">${esc(b.desc)}</p>
      <div class="kv-grid">
        <div class="kv"><div class="k">Format</div><div class="v">${esc(b.format)}</div></div>
        <div class="kv"><div class="k">Pages</div><div class="v">${b.pages}</div></div>
        <div class="kv"><div class="k">Published</div><div class="v">${esc(b.published)}</div></div>
        <div class="kv"><div class="k">ISBN</div><div class="v" style="font-family:ui-monospace,Menlo,monospace;font-size:12.6px">${esc(b.isbn)}</div></div>
      </div>
    `, `
      <button class="btn btn-ghost" data-action="close-modal">Close</button>
      <button class="btn btn-primary" data-action="buy-book" data-id="${b.id}"><i data-lucide="shopping-bag"></i> Buy this book</button>
    `);
    return;
  }
  if(action === 'buy-bundle'){
    openModal('Full-Stack Developer\'s Library', `
      <p style="font-size:14.6px;line-height:1.72;color:var(--ink-500);margin-bottom:22px">
        Four titles covering the entire modern stack. Everything you need for a full-stack career,
        in a single bundle at 32% off the individual prices.
      </p>
      <div style="display:flex;flex-direction:column;gap:12px">
        ${BOOKS.slice(0,4).map(b=>`
          <div style="display:flex;gap:14px;align-items:center;padding:12px;border:1px solid var(--cream-300);border-radius:var(--radius-sm)">
            <img src="${b.cover}" alt="" style="width:44px;height:58px;border-radius:4px;object-fit:cover" onerror="this.style.display='none'">
            <div style="flex:1;min-width:0">
              <div style="font-size:13.6px;font-weight:600;color:var(--ink-900);line-height:1.35">${esc(b.title)}</div>
              <div class="small muted" style="margin-top:2px">by ${esc(b.author)}</div>
            </div>
            <span style="font-weight:700;font-size:13.6px;color:var(--wine-800)">${money(b.price)}</span>
          </div>`).join('')}
      </div>
      <div style="display:flex;justify-content:space-between;align-items:center;padding:18px 0;border-bottom:1px solid var(--cream-300);margin-top:14px">
        <span class="muted">Individual total</span>
        <s style="font-size:14px;color:var(--ink-400)">${money(BOOKS.slice(0,4).reduce((n,b)=>n+b.price,0))}</s>
      </div>
      <div style="display:flex;justify-content:space-between;align-items:center;padding-top:16px">
        <span style="font-weight:600;color:var(--ink-900)">Bundle price</span>
        <span class="price" style="font-size:1.6rem;color:var(--mustard-600)">$112</span>
      </div>
    `, `
      <button class="btn btn-ghost" data-action="close-modal">Cancel</button>
      <button class="btn btn-gold" data-action="toast-demo" data-msg="Bundle added to cart — demo only"><i data-lucide="shopping-bag"></i> Add bundle to cart</button>
    `);
    return;
  }

  if(action === 'toggle-pw'){
    const input = el.parentElement.querySelector('input');
    if(!input) return;
    const show = input.type === 'password';
    input.type = show ? 'text' : 'password';
    el.innerHTML = `<i data-lucide="${show?'eye-off':'eye'}"></i>`;
    icons();
    return;
  }

  if(action === 'toast-demo'){ toast(el.dataset.msg || 'Action completed','This is a frontend demonstration.'); return; }
  if(action === 'demo-social'){ toast('Social login unavailable','Connect a real OAuth provider to enable this.','gold'); return; }
  if(action === 'resume'){ toast('Resuming lesson','Playback would start here in production.','gold'); return; }
  if(action === 'view-cert'){
    openModal('Certificate preview', `
      <div style="border:1px solid var(--cream-300);border-radius:var(--radius);padding:36px;text-align:center;background:linear-gradient(150deg,var(--cream-0),var(--wine-50))">
        <div class="logo-mark" style="width:46px;height:46px;margin:0 auto 16px">${logoSVG()}</div>
        <div style="font-size:11.5px;font-weight:700;letter-spacing:.18em;text-transform:uppercase;color:var(--mustard-700)">Certificate of Completion</div>
        <p style="font-family:var(--font-display);font-size:1.7rem;font-weight:600;color:var(--wine-900);margin-top:20px">Elena Petrova</p>
        <p class="small muted" style="margin-top:10px">has successfully completed</p>
        <p style="font-family:var(--font-display);font-size:1.22rem;font-weight:600;color:var(--wine-700);margin-top:8px">Data Analytics with Python & SQL</p>
        <div style="display:flex;justify-content:center;gap:34px;margin-top:28px;flex-wrap:wrap">
          <div><div class="small muted">Issued</div><div style="font-weight:600;font-size:13.6px">14 September 2025</div></div>
          <div><div class="small muted">Grade</div><div style="font-weight:600;font-size:13.6px">Merit</div></div>
          <div><div class="small muted">Serial</div><div style="font-weight:600;font-size:13.6px">VA-2025-002031</div></div>
        </div>
      </div>`, `
      <button class="btn btn-ghost" data-action="close-modal">Close</button>
      <button class="btn btn-primary" data-action="toast-demo" data-msg="Certificate downloaded as PDF"><i data-lucide="download"></i> Download PDF</button>
    `);
    return;
  }
  if(action === 'close-modal'){ closeModal(); return; }

  if(action === 'new-course' || action === 'edit-course'){
    const c = el.dataset.id ? courseById(el.dataset.id) : null;
    openModal(c ? 'Edit course' : 'Add new course', `
      <div class="field"><label class="label">Course title</label><input class="input" value="${c?esc(c.title):''}" placeholder="e.g. The Complete Web Development Bootcamp"></div>
      <div class="field"><label class="label">Short description</label><textarea class="textarea" style="min-height:80px" placeholder="One-sentence summary shown on course cards">${c?esc(c.short):''}</textarea></div>
      <div class="grid g2 gap-sm" style="gap:0 16px">
        <div class="field"><label class="label">Category</label>
          <select class="select">${CATEGORIES.map(x=>`<option ${c&&c.cat===x.id?'selected':''}>${esc(x.name)}</option>`).join('')}</select>
        </div>
        <div class="field"><label class="label">Instructor</label>
          <select class="select">${INSTRUCTORS.map(x=>`<option ${c&&c.instructor===x.id?'selected':''}>${esc(x.name)}</option>`).join('')}</select>
        </div>
      </div>
      <div class="grid g2 gap-sm" style="gap:0 16px">
        <div class="field"><label class="label">Level</label>
          <select class="select"><option>Beginner</option><option ${c&&c.level==='Intermediate'?'selected':''}>Intermediate</option><option ${c&&c.level==='Advanced'?'selected':''}>Advanced</option></select>
        </div>
        <div class="field"><label class="label">Price (USD)</label><input class="input" type="number" value="${c?c.price:''}"></div>
      </div>
      <div class="field" style="margin-bottom:0"><label class="label">Course thumbnail</label>
        <div class="upload-box"><i data-lucide="image-plus"></i><p>Click to upload a course thumbnail</p><span>JPG or PNG, 1280×720 px recommended</span></div>
      </div>`, `
      <button class="btn btn-ghost" data-action="close-modal">Cancel</button>
      <button class="btn btn-outline" data-action="toast-demo" data-msg="Course saved as draft">Save as draft</button>
      <button class="btn btn-primary" data-action="toast-demo" data-msg="${c?'Course updated':'Course created'} successfully">${c?'Update course':'Create course'}</button>
    `);
    return;
  }
  if(action === 'new-instructor' || action === 'edit-instructor'){
    openModal('Instructor details', `
      <div class="field"><label class="label">Full name</label><input class="input" value="Dr. Amara Osei"></div>
      <div class="field"><label class="label">Email address</label><input class="input" type="email" value="amara.osei@verdantacademy.com"></div>
      <div class="field"><label class="label">Professional title</label><input class="input" value="Lead Data Scientist"></div>
      <div class="field"><label class="label">Biography</label><textarea class="textarea" style="min-height:90px">Former principal data scientist with 12 years across fintech and healthcare analytics.</textarea></div>
      <div class="field"><label class="label">Expertise (comma separated)</label><input class="input" value="Python, Machine Learning, SQL"></div>
      <div class="field" style="margin-bottom:0"><label class="label">Profile image</label>
        <div class="upload-box"><i data-lucide="image-plus"></i><p>Click to upload a profile photo</p><span>JPG or PNG, max 2 MB</span></div>
      </div>`, `
      <button class="btn btn-ghost" data-action="close-modal">Cancel</button>
      <button class="btn btn-primary" data-action="toast-demo" data-msg="Instructor saved">Save instructor</button>
    `);
    return;
  }
  if(action === 'new-category'){
    openModal('Add category', `
      <div class="field"><label class="label">Category name</label><input class="input" placeholder="e.g. Mobile Development"></div>
      <div class="field"><label class="label">Slug</label><input class="input" placeholder="mobile-development" value="mobile-development"></div>
      <div class="field"><label class="label">Description</label><textarea class="textarea" style="min-height:80px" placeholder="Short description shown on the category card"></textarea></div>
      <div class="field"><label class="label">Category image</label>
        <div class="upload-box"><i data-lucide="image-plus"></i><p>Click to upload an image</p><span>JPG or PNG, 800×500 px recommended</span></div>
      </div>
      <div style="display:flex;justify-content:space-between;align-items:center;padding-top:6px">
        <div><div style="font-size:14px;font-weight:600;color:var(--ink-900)">Active</div><div class="small muted">Visible on the public website</div></div>
        <label class="toggle-switch"><input type="checkbox" checked><span class="toggle-slider"></span></label>
      </div>`, `
      <button class="btn btn-ghost" data-action="close-modal">Cancel</button>
      <button class="btn btn-primary" data-action="toast-demo" data-msg="Category created">Create category</button>
    `);
    return;
  }
  if(action === 'new-post'){
    openModal('New blog article', `
      <div class="field"><label class="label">Article title</label><input class="input" placeholder="e.g. How to Choose Your First Programming Language"></div>
      <div class="field"><label class="label">URL slug</label><input class="input" placeholder="how-to-choose-first-programming-language"></div>
      <div class="grid g2 gap-sm" style="gap:0 16px">
        <div class="field"><label class="label">Category</label><select class="select"><option>Career</option><option>Learning</option><option>Data</option><option>Design</option></select></div>
        <div class="field"><label class="label">Author</label><select class="select">${INSTRUCTORS.map(i=>`<option>${esc(i.name)}</option>`).join('')}</select></div>
      </div>
      <div class="field"><label class="label">Excerpt</label><textarea class="textarea" style="min-height:70px" placeholder="Short summary shown on the blog listing page"></textarea></div>
      <div class="field" style="margin-bottom:0"><label class="label">Featured image</label>
        <div class="upload-box"><i data-lucide="image-plus"></i><p>Click to upload a cover image</p><span>JPG or PNG, 1200×675 px recommended</span></div>
      </div>`, `
      <button class="btn btn-ghost" data-action="close-modal">Cancel</button>
      <button class="btn btn-outline" data-action="toast-demo" data-msg="Article saved as draft">Save draft</button>
      <button class="btn btn-primary" data-action="toast-demo" data-msg="Article published">Publish</button>
    `);
    return;
  }
  if(action === 'new-faq'){
    openModal('Add FAQ', `
      <div class="field"><label class="label">Question</label><input class="input" placeholder="e.g. How do I get a refund?"></div>
      <div class="field"><label class="label">Answer</label><textarea class="textarea" style="min-height:110px" placeholder="Provide a clear, complete answer"></textarea></div>
      <div class="field"><label class="label">Category</label><select class="select"><option>General</option><option>Payments</option><option>Certificates</option><option>Access</option><option>Learning</option><option>Technical</option><option>Support</option></select></div>
      <div style="display:flex;justify-content:space-between;align-items:center;padding-top:6px">
        <div><div style="font-size:14px;font-weight:600;color:var(--ink-900)">Published</div><div class="small muted">Visible in the public help centre</div></div>
        <label class="toggle-switch"><input type="checkbox" checked><span class="toggle-slider"></span></label>
      </div>`, `
      <button class="btn btn-ghost" data-action="close-modal">Cancel</button>
      <button class="btn btn-primary" data-action="toast-demo" data-msg="FAQ created">Create FAQ</button>
    `);
    return;
  }
  if(action === 'new-notification'){
    openModal('Send announcement', `
      <div class="field"><label class="label">Title</label><input class="input" placeholder="e.g. New course launch"></div>
      <div class="field"><label class="label">Message</label><textarea class="textarea" style="min-height:110px" placeholder="Write your announcement…"></textarea></div>
      <div class="field"><label class="label">Audience</label>
        <select class="select"><option>All users</option><option>All students</option><option>Subscribers only</option><option>Instructors</option></select>
      </div>
      <div style="display:flex;justify-content:space-between;align-items:center;padding-top:6px">
        <div><div style="font-size:14px;font-weight:600;color:var(--ink-900)">Also send by email</div><div class="small muted">Deliver to the audience inbox as well</div></div>
        <label class="toggle-switch"><input type="checkbox"><span class="toggle-slider"></span></label>
      </div>`, `
      <button class="btn btn-ghost" data-action="close-modal">Cancel</button>
      <button class="btn btn-primary" data-action="toast-demo" data-msg="Announcement sent to 48,512 users">Send now</button>
    `);
    return;
  }
  if(action === 'new-media'){
    openModal('Upload files', `
      <div class="upload-box" style="padding:46px">
        <i data-lucide="upload-cloud"></i>
        <p style="font-weight:600;font-size:14.6px;color:var(--ink-900)">Drop files here or click to browse</p>
        <span>Images, PDFs and video up to 50 MB each</span>
      </div>
      <div style="margin-top:18px">
        <div class="small muted" style="margin-bottom:9px">Selected files</div>
        <div style="display:flex;align-items:center;gap:11px;padding:12px;border:1px solid var(--cream-300);border-radius:var(--radius-sm)">
          <div class="stat-icon" style="width:38px;height:38px"><i data-lucide="image"></i></div>
          <div style="flex:1"><div style="font-size:13.6px;font-weight:600">course-thumbnail.jpg</div><div class="small muted">840 KB</div></div>
          <button class="mini-btn danger" data-action="toast-demo" data-msg="File removed"><i data-lucide="x"></i></button>
        </div>
      </div>`, `
      <button class="btn btn-ghost" data-action="close-modal">Cancel</button>
      <button class="btn btn-primary" data-action="toast-demo" data-msg="1 file uploaded to media library">Upload</button>
    `);
    return;
  }
  if(action === 'add-module'){
    openModal('Add module', `
      <div class="field"><label class="label">Module title</label><input class="input" placeholder="e.g. Deployment & DevOps Basics"></div>
      <div class="field" style="margin-bottom:0"><label class="label">Module summary</label><textarea class="textarea" style="min-height:80px" placeholder="What will students learn in this module?"></textarea></div>`, `
      <button class="btn btn-ghost" data-action="close-modal">Cancel</button>
      <button class="btn btn-primary" data-action="toast-demo" data-msg="Module added to curriculum">Add module</button>
    `);
    return;
  }
  if(action === 'add-lesson' || action === 'edit-lesson'){
    openModal(action === 'edit-lesson' ? 'Edit lesson' : 'Add lesson', `
      <div class="field"><label class="label">Lesson title</label><input class="input" value="Authentication and sessions"></div>
      <div class="field"><label class="label">Video URL</label><input class="input" placeholder="https://videos.verdantacademy.com/lesson.mp4"></div>
      <div class="grid g2 gap-sm" style="gap:0 16px">
        <div class="field"><label class="label">Duration</label><input class="input" placeholder="00:00"></div>
        <div class="field"><label class="label">Order</label><input class="input" type="number" value="4"></div>
      </div>
      <div class="field"><label class="label">Lesson description</label><textarea class="textarea" style="min-height:80px" placeholder="Brief description of what this lesson covers"></textarea></div>
      <div class="field" style="margin-bottom:0"><label class="label">Downloadable resources</label>
        <div class="upload-box" style="padding:22px"><i data-lucide="paperclip"></i><p>Attach worksheets, code files or slides</p></div>
      </div>
      <div style="display:flex;justify-content:space-between;align-items:center;padding-top:16px">
        <div><div style="font-size:14px;font-weight:600;color:var(--ink-900)">Free preview</div><div class="small muted">Allow visitors to watch without enrolling</div></div>
        <label class="toggle-switch"><input type="checkbox"><span class="toggle-slider"></span></label>
      </div>`, `
      <button class="btn btn-ghost" data-action="close-modal">Cancel</button>
      <button class="btn btn-primary" data-action="toast-demo" data-msg="Lesson saved">Save lesson</button>
    `);
    return;
  }
  if(action === 'edit-module'){
    openModal('Edit module', `
      <div class="field"><label class="label">Module title</label><input class="input" value="Foundations of the Web"></div>
      <div class="field" style="margin-bottom:0"><label class="label">Module summary</label><textarea class="textarea" style="min-height:80px">How the web works, HTML semantics, CSS layout and responsive design principles.</textarea></div>`, `
      <button class="btn btn-ghost" data-action="close-modal">Cancel</button>
      <button class="btn btn-primary" data-action="toast-demo" data-msg="Module updated">Save module</button>
    `);
    return;
  }
  if(action === 'view-student'){
    const s = studentById(el.dataset.id);
    openModal('Student details', `
      <div style="display:flex;gap:18px;align-items:center;margin-bottom:24px">
        <img src="${s.img}" alt="" style="width:68px;height:68px;border-radius:50%;object-fit:cover;box-shadow:0 6px 16px rgba(32,8,15,.12)" onerror="this.style.display='none'">
        <div>
          <div style="font-size:16px;font-weight:600;color:var(--ink-900)">${esc(s.name)}</div>
          <div class="small muted" style="margin-top:3px">${esc(s.email)}</div>
          <span class="badge ${s.status==='Active'?'badge-success':'badge-ivory'}" style="margin-top:8px">${esc(s.status)}</span>
        </div>
      </div>
      <div class="kv-grid">
        <div class="kv"><div class="k">Joined</div><div class="v">${esc(s.joined)}</div></div>
        <div class="kv"><div class="k">Enrolled courses</div><div class="v">${s.courses}</div></div>
        <div class="kv"><div class="k">Average progress</div><div class="v">${s.progress}%</div></div>
        <div class="kv"><div class="k">Total spent</div><div class="v">${money(s.spent)}</div></div>
      </div>
      <h3 style="font-size:14.6px;margin:26px 0 12px">Enrolled courses</h3>
      ${COURSES.slice(0,s.courses).map(c=>`
        <div style="display:flex;align-items:center;gap:11px;padding:11px 0;border-bottom:1px solid var(--cream-200)">
          <img src="${c.thumb}" alt="" style="width:46px;height:34px;border-radius:6px;object-fit:cover" onerror="this.style.display='none'">
          <div style="flex:1"><div style="font-size:13.6px;font-weight:600;color:var(--ink-900)">${esc(c.title)}</div></div>
          <span class="small" style="font-weight:700;color:var(--wine-800)">${Math.round(s.progress*0.9)}%</span>
        </div>`).join('')}
    `, `<button class="btn btn-ghost" data-action="close-modal">Close</button>
        <button class="btn btn-primary" data-action="toast-demo" data-msg="Student record updated">Save changes</button>`);
    return;
  }
  if(action === 'view-message'){
    const m = MESSAGES.find(x=>x.id===el.dataset.id) || MESSAGES[0];
    openModal(m.subject, `
      <div class="kv-grid" style="margin-bottom:20px">
        <div class="kv"><div class="k">From</div><div class="v">${esc(m.name)}</div></div>
        <div class="kv"><div class="k">Email</div><div class="v" style="font-size:13.4px">${esc(m.email)}</div></div>
        <div class="kv"><div class="k">Received</div><div class="v">${esc(m.date)}</div></div>
      </div>
      <div style="background:var(--cream-100);border:1px solid var(--cream-300);border-radius:var(--radius);padding:18px;font-size:14.4px;line-height:1.75;color:var(--ink-700)">
        ${esc(m.body)}
      </div>
      <div class="field" style="margin-top:22px;margin-bottom:0">
        <label class="label">Your reply</label>
        <textarea class="textarea" style="min-height:110px" placeholder="Type your response…"></textarea>
      </div>`, `
      <button class="btn btn-ghost" data-action="close-modal">Close</button>
      <button class="btn btn-outline" data-action="toast-demo" data-msg="Message marked as read">Mark as read</button>
      <button class="btn btn-primary" data-action="toast-demo" data-msg="Reply sent to ${esc(m.email)}">Send reply</button>
    `);
    return;
  }
  if(action === 'reply-message'){
    const m = MESSAGES.find(x=>x.id===el.dataset.id) || MESSAGES[0];
    openModal('Reply to ' + m.name, `
      <div class="field"><label class="label">To</label><input class="input" value="${esc(m.email)}" readonly></div>
      <div class="field"><label class="label">Subject</label><input class="input" value="Re: ${esc(m.subject)}"></div>
      <div class="field" style="margin-bottom:0"><label class="label">Message</label><textarea class="textarea" style="min-height:150px" placeholder="Type your reply…"></textarea></div>`, `
      <button class="btn btn-ghost" data-action="close-modal">Cancel</button>
      <button class="btn btn-primary" data-action="toast-demo" data-msg="Reply sent">Send reply</button>
    `);
    return;
  }
  if(action === 'delete-row'){
    const name = el.dataset.name || 'this record';
    openModal('Confirm deletion', `
      <div style="display:flex;gap:15px;align-items:flex-start">
        <div class="stat-icon" style="width:46px;height:46px;background:var(--danger-bg);color:var(--danger);border-color:#F0CFD1;flex:none"><i data-lucide="alert-triangle"></i></div>
        <div>
          <p style="font-size:15px;color:var(--ink-900);font-weight:600">Delete ${esc(name)}?</p>
          <p style="font-size:14px;color:var(--ink-500);margin-top:8px;line-height:1.65">
            This action cannot be undone. Any associated data will be permanently removed from the platform.
          </p>
        </div>
      </div>`, `
      <button class="btn btn-ghost" data-action="close-modal">Cancel</button>
      <button class="btn btn-danger" data-action="confirm-delete" data-name="${esc(name)}"><i data-lucide="trash-2"></i> Delete permanently</button>
    `);
    return;
  }
  if(action === 'confirm-delete'){ closeModal(); toast('Record deleted', el.dataset.name + ' has been removed.', 'err'); return; }
  if(action === 'toggle-publish'){ toast('Course status updated','Published status toggled for this course.','gold'); return; }
  if(action === 'save-settings'){ toast('Settings saved','Your changes have been applied.'); return; }
  if(action === 'pref-toggle'){ toast('Preference updated', el.checked ? 'Option enabled.' : 'Option disabled.', 'gold'); return; }
  if(action === 'new-enrollment' || action === 'new-student' || action === 'new-subscriber' || action === 'new-page'){
    toast('Demo form', 'This action opens a creation form in the full application.', 'gold');
    return;
  }
  if(action === 'switch-course'){ toast('Course switched','Loading curriculum for the selected course.','gold'); return; }
});

document.addEventListener('click', (e)=>{ if(e.target.id === 'modalRoot') closeModal(); });
document.addEventListener('keydown', (e)=>{ if(e.key === 'Escape') closeModal(); });

document.addEventListener('input', (e)=>{
  const el = e.target;
  if(el.dataset.filter){
    const map = {q:'courseFilters.q',cat:'courseFilters.cat',level:'courseFilters.level',price:'courseFilters.price',sort:'courseFilters.sort',
                 bq:'bookFilters.q',bcat:'bookFilters.cat',bformat:'bookFilters.format',bsort:'bookFilters.sort'};
    const key = el.dataset.filter;
    if(key === 'bq') State.bookFilters.q = el.value;
    else if(key === 'bcat') State.bookFilters.cat = el.value;
    else if(key === 'bformat') State.bookFilters.format = el.value;
    else if(key === 'bsort') State.bookFilters.sort = el.value;
    else State.courseFilters[key] = el.value;
    if(key !== 'bsort' && key !== 'bcat' && key !== 'bformat') State.courseFilters.page = 1;
    const pos = el.selectionStart;
    clearTimeout(window.__filterTimer);
    window.__filterTimer = setTimeout(()=>{
      render();
      const again = document.querySelector(`[data-filter="${key}"]`);
      if(again){ again.focus(); try{ again.setSelectionRange(pos,pos); }catch(err){} }
    }, 320);
  }
  if(el.dataset.action === 'table-search'){
    const q = el.value.toLowerCase();
    const table = el.closest('.table-wrap');
    if(!table) return;
    table.querySelectorAll('tbody tr').forEach(tr=>{
      tr.style.display = tr.textContent.toLowerCase().includes(q) ? '' : 'none';
    });
    table.querySelectorAll('.mobile-list .mcard').forEach(card=>{
      card.style.display = card.textContent.toLowerCase().includes(q) ? '' : 'none';
    });
  }
  if(el.dataset.action === 'avatar-input' && el.files && el.files[0]){
    const url = URL.createObjectURL(el.files[0]);
    const prev = document.getElementById('avatarPreview');
    if(prev) prev.src = url;
    toast('Photo selected','Preview updated. Save changes to apply.','gold');
  }
});

document.addEventListener('change', (e)=>{
  const el = e.target;
  if(el.dataset.filter){
    const key = el.dataset.filter;
    if(key === 'bcat') State.bookFilters.cat = el.value;
    else if(key === 'bformat') State.bookFilters.format = el.value;
    else if(key === 'bsort') State.bookFilters.sort = el.value;
    else { State.courseFilters[key] = el.value; State.courseFilters.page = 1; }
    render();
  }
  if(el.dataset.action === 'table-filter'){
    const val = el.value;
    const table = el.closest('.table-wrap');
    if(!table || val === 'All statuses') return;
    table.querySelectorAll('tbody tr').forEach(tr=>{
      tr.style.display = tr.textContent.toLowerCase().includes(val.toLowerCase()) ? '' : 'none';
    });
    toast('Filter applied','Showing records matching “'+val+'”.','gold');
  }
});

document.addEventListener('submit', (e)=>{
  const form = e.target;
  const action = form.dataset.action;
  if(!action) return;
  e.preventDefault();

  const msg = form.querySelector('.form-msg');
  const setMsg = (ok, text)=>{
    if(!msg) return;
    msg.className = 'form-msg show ' + (ok ? 'ok' : 'err');
    msg.innerHTML = `<i data-lucide="${ok?'check-circle-2':'alert-circle'}"></i><span>${esc(text)}</span>`;
    icons();
  };
  const markInvalid = (field, invalid)=>{ field.classList.toggle('invalid', invalid); };

  if(action === 'newsletter'){
    const email = form.querySelector('input[type=email]');
    const valid = /^[^\s@]+@[^\s@]+\.[^\s@]{2,}$/.test(email.value.trim());
    if(!valid){ setMsg(false,'Please enter a valid email address.'); email.focus(); return; }
    setMsg(true,'Thank you — please check your inbox to confirm your subscription.');
    form.reset();
    toast('Subscribed successfully','Welcome to the Verdant newsletter.');
    return;
  }

  if(action === 'contact'){
    let ok = true;
    const name = form.querySelector('[name=name]');
    const email = form.querySelector('[name=email]');
    const subject = form.querySelector('[name=subject]');
    const message = form.querySelector('[name=message]');
    const consent = form.querySelector('[name=consent]');

    markInvalid(name.closest('.field'), name.value.trim().length < 2); if(name.value.trim().length < 2) ok = false;
    markInvalid(email.closest('.field'), !/^[^\s@]+@[^\s@]+\.[^\s@]{2,}$/.test(email.value.trim())); if(!/^[^\s@]+@[^\s@]+\.[^\s@]{2,}$/.test(email.value.trim())) ok = false;
    markInvalid(subject.closest('.field'), !subject.value); if(!subject.value) ok = false;
    markInvalid(message.closest('.field'), message.value.trim().length < 20); if(message.value.trim().length < 20) ok = false;

    if(!consent.checked){ ok = false; setMsg(false,'Please accept the privacy policy to continue.'); }
    if(!ok){ if(consent.checked) setMsg(false,'Please correct the highlighted fields.'); return; }

    setMsg(true,'Message sent. Our team will reply within one business day.');
    form.reset();
    toast('Message sent','Thank you — we will be in touch shortly.');
    return;
  }



  if(action === 'profile'){
    setMsg(true,'Profile updated successfully.');
    toast('Profile saved','Your changes have been applied.');
    return;
  }

  if(action === 'change-password'){
    const cur = form.querySelector('[name=current]');
    const np = form.querySelector('[name=newpass]');
    const cf = form.querySelector('[name=confirm]');
    let ok = true;
    markInvalid(cur.closest('.field'), cur.value.length < 1); if(!cur.value) ok = false;
    markInvalid(np.closest('.field'), np.value.length < 8); if(np.value.length < 8) ok = false;
    markInvalid(cf.closest('.field'), cf.value !== np.value || !cf.value); if(cf.value !== np.value || !cf.value) ok = false;
    if(!ok){ setMsg(false,'Please correct the highlighted fields.'); return; }
    setMsg(true,'Password updated. You have been signed out of other devices.');
    toast('Password changed','Your account is now more secure.');
    form.reset();
    return;
  }
});

document.addEventListener('click', (e)=>{
  const a = e.target.closest('.main-nav a');
  if(a){ const nav = $('#mainNav'); nav && nav.classList.remove('open'); }
  const side = e.target.closest('.sidebar a.side-link');
  if(side && window.innerWidth < 1024){
    const sb = $('#sidebar'), sc = $('#scrim');
    sb && sb.classList.remove('open'); sc && sc.classList.remove('show');
  }
});



window.addEventListener('DOMContentLoaded', () => {
  icons();
  runCounters();
  applyResponsiveGrids();
});
if (document.readyState !== 'loading') {
  icons();
  runCounters();
  applyResponsiveGrids();
}