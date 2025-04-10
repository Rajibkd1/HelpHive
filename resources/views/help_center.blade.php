@extends('customer.sidebar')

@section('sidebar-content')

<body class="bg-gradient-to-br from-yellow-50 to-amber-50 min-h-screen">

  
  <!-- Hero Section -->
  <div class="bg-white shadow-md">
    <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
      <div class="text-center">
        <h1 class="text-4xl font-extrabold text-gray-900 sm:text-5xl sm:tracking-tight lg:text-6xl">How can we help?</h1>
        <p class="mt-5 max-w-xl mx-auto text-xl text-gray-500">Find the answers you need from our knowledge base or contact our support team directly.</p>
        <div class="mt-8 max-w-xl mx-auto">
          <div class="mt-1 relative rounded-md shadow-md">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
              <i class="fas fa-search text-gray-400"></i>
            </div>
            <input type="text" class="focus:ring-yellow-500 focus:border-yellow-500 block w-full pl-10 pr-12 py-4 sm:text-lg border-gray-200 rounded-lg" placeholder="Search the knowledge base...">
            <div class="absolute inset-y-0 right-0 flex py-1.5 pr-1.5">
              <button class="inline-flex items-center px-4 border border-transparent text-base font-medium rounded-md text-white bg-yellow-500 hover:bg-yellow-600">
                Search
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Categories Section -->
  <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
    <h2 class="text-3xl font-bold text-center text-gray-800 mb-12">Browse by Category</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
      <!-- Category 1 -->
      <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition duration-300 transform hover:-translate-y-1">
        <div class="p-8">
          <div class="bg-yellow-100 rounded-full w-16 h-16 flex items-center justify-center mb-5">
            <i class="fas fa-box-open text-yellow-600 text-2xl"></i>
          </div>
          <h3 class="text-xl font-bold text-gray-800 mb-3">Getting Started</h3>
          <p class="text-gray-600 mb-4">Everything you need to know to set up and start using HelpHive effectively.</p>
          <a href="#" class="text-yellow-600 hover:text-yellow-700 font-medium inline-flex items-center">
            View articles <i class="fas fa-arrow-right ml-2"></i>
          </a>
          <div class="mt-4 text-sm text-gray-500">
            <span>25 articles</span>
          </div>
        </div>
      </div>

      <!-- Category 2 -->
      <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition duration-300 transform hover:-translate-y-1">
        <div class="p-8">
          <div class="bg-green-100 rounded-full w-16 h-16 flex items-center justify-center mb-5">
            <i class="fas fa-cogs text-green-600 text-2xl"></i>
          </div>
          <h3 class="text-xl font-bold text-gray-800 mb-3">Account Management</h3>
          <p class="text-gray-600 mb-4">Learn how to manage your account, teams, permissions and billing details.</p>
          <a href="#" class="text-yellow-600 hover:text-yellow-700 font-medium inline-flex items-center">
            View articles <i class="fas fa-arrow-right ml-2"></i>
          </a>
          <div class="mt-4 text-sm text-gray-500">
            <span>18 articles</span>
          </div>
        </div>
      </div>

      <!-- Category 3 -->
      <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition duration-300 transform hover:-translate-y-1">
        <div class="p-8">
          <div class="bg-blue-100 rounded-full w-16 h-16 flex items-center justify-center mb-5">
            <i class="fas fa-chart-line text-blue-600 text-2xl"></i>
          </div>
          <h3 class="text-xl font-bold text-gray-800 mb-3">Analytics & Reporting</h3>
          <p class="text-gray-600 mb-4">Understand how to utilize our analytics tools to improve your customer service.</p>
          <a href="#" class="text-yellow-600 hover:text-yellow-700 font-medium inline-flex items-center">
            View articles <i class="fas fa-arrow-right ml-2"></i>
          </a>
          <div class="mt-4 text-sm text-gray-500">
            <span>14 articles</span>
          </div>
        </div>
      </div>

      <!-- Category 4 -->
      <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition duration-300 transform hover:-translate-y-1">
        <div class="p-8">
          <div class="bg-purple-100 rounded-full w-16 h-16 flex items-center justify-center mb-5">
            <i class="fas fa-robot text-purple-600 text-2xl"></i>
          </div>
          <h3 class="text-xl font-bold text-gray-800 mb-3">AI Automation</h3>
          <p class="text-gray-600 mb-4">Set up and customize AI chatbots to provide instant answers to common questions.</p>
          <a href="#" class="text-yellow-600 hover:text-yellow-700 font-medium inline-flex items-center">
            View articles <i class="fas fa-arrow-right ml-2"></i>
          </a>
          <div class="mt-4 text-sm text-gray-500">
            <span>12 articles</span>
          </div>
        </div>
      </div>

      <!-- Category 5 -->
      <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition duration-300 transform hover:-translate-y-1">
        <div class="p-8">
          <div class="bg-red-100 rounded-full w-16 h-16 flex items-center justify-center mb-5">
            <i class="fas fa-shield-alt text-red-600 text-2xl"></i>
          </div>
          <h3 class="text-xl font-bold text-gray-800 mb-3">Security & Privacy</h3>
          <p class="text-gray-600 mb-4">Learn about our security practices and how to keep your customer data safe.</p>
          <a href="#" class="text-yellow-600 hover:text-yellow-700 font-medium inline-flex items-center">
            View articles <i class="fas fa-arrow-right ml-2"></i>
          </a>
          <div class="mt-4 text-sm text-gray-500">
            <span>9 articles</span>
          </div>
        </div>
      </div>

      <!-- Category 6 -->
      <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition duration-300 transform hover:-translate-y-1">
        <div class="p-8">
          <div class="bg-teal-100 rounded-full w-16 h-16 flex items-center justify-center mb-5">
            <i class="fas fa-puzzle-piece text-teal-600 text-2xl"></i>
          </div>
          <h3 class="text-xl font-bold text-gray-800 mb-3">Integrations</h3>
          <p class="text-gray-600 mb-4">Connect HelpHive with your favorite tools and extend its functionality.</p>
          <a href="#" class="text-yellow-600 hover:text-yellow-700 font-medium inline-flex items-center">
            View articles <i class="fas fa-arrow-right ml-2"></i>
          </a>
          <div class="mt-4 text-sm text-gray-500">
            <span>16 articles</span>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Popular Articles -->
  <div class="bg-white">
    <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
      <h2 class="text-3xl font-bold text-center text-gray-800 mb-12">Popular Articles</h2>
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        <div class="flex items-start space-x-4">
          <div class="flex-shrink-0">
            <div class="bg-yellow-100 rounded-full w-10 h-10 flex items-center justify-center">
              <i class="fas fa-file-alt text-yellow-600"></i>
            </div>
          </div>
          <div>
            <h3 class="text-lg font-medium text-gray-800 hover:text-yellow-600">
              <a href="#">How to set up your first ticket queue</a>
            </h3>
            <p class="mt-1 text-sm text-gray-500">5 min read</p>
          </div>
        </div>

        <div class="flex items-start space-x-4">
          <div class="flex-shrink-0">
            <div class="bg-yellow-100 rounded-full w-10 h-10 flex items-center justify-center">
              <i class="fas fa-file-alt text-yellow-600"></i>
            </div>
          </div>
          <div>
            <h3 class="text-lg font-medium text-gray-800 hover:text-yellow-600">
              <a href="#">Creating custom response templates</a>
            </h3>
            <p class="mt-1 text-sm text-gray-500">3 min read</p>
          </div>
        </div>

        <div class="flex items-start space-x-4">
          <div class="flex-shrink-0">
            <div class="bg-yellow-100 rounded-full w-10 h-10 flex items-center justify-center">
              <i class="fas fa-file-alt text-yellow-600"></i>
            </div>
          </div>
          <div>
            <h3 class="text-lg font-medium text-gray-800 hover:text-yellow-600">
              <a href="#">Setting up automated workflows</a>
            </h3>
            <p class="mt-1 text-sm text-gray-500">7 min read</p>
          </div>
        </div>

        <div class="flex items-start space-x-4">
          <div class="flex-shrink-0">
            <div class="bg-yellow-100 rounded-full w-10 h-10 flex items-center justify-center">
              <i class="fas fa-file-alt text-yellow-600"></i>
            </div>
          </div>
          <div>
            <h3 class="text-lg font-medium text-gray-800 hover:text-yellow-600">
              <a href="#">How to import customer data</a>
            </h3>
            <p class="mt-1 text-sm text-gray-500">4 min read</p>
          </div>
        </div>

        <div class="flex items-start space-x-4">
          <div class="flex-shrink-0">
            <div class="bg-yellow-100 rounded-full w-10 h-10 flex items-center justify-center">
              <i class="fas fa-file-alt text-yellow-600"></i>
            </div>
          </div>
          <div>
            <h3 class="text-lg font-medium text-gray-800 hover:text-yellow-600">
              <a href="#">Configuring email notifications</a>
            </h3>
            <p class="mt-1 text-sm text-gray-500">3 min read</p>
          </div>
        </div>

        <div class="flex items-start space-x-4">
          <div class="flex-shrink-0">
            <div class="bg-yellow-100 rounded-full w-10 h-10 flex items-center justify-center">
              <i class="fas fa-file-alt text-yellow-600"></i>
            </div>
          </div>
          <div>
            <h3 class="text-lg font-medium text-gray-800 hover:text-yellow-600">
              <a href="#">How to connect your CRM system</a>
            </h3>
            <p class="mt-1 text-sm text-gray-500">6 min read</p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Contact Section -->
  <div class="max-w-7xl mx-auto py-16 px-4 sm:px-6 lg:px-8">
    <div class="bg-gradient-to-r from-yellow-500 to-amber-600 rounded-2xl shadow-xl overflow-hidden">
      <div class="grid grid-cols-1 lg:grid-cols-2">
        <!-- Contact Form -->
        <div class="bg-white p-8 lg:p-12">
          <h2 class="text-3xl font-bold text-gray-800 mb-6">Contact Support</h2>
          <p class="text-gray-600 mb-8">Can't find what you're looking for? Our support team is here to help you.</p>
          
          <form>
            <div class="space-y-6">
              <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Full name</label>
                <input type="text" id="name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-yellow-500 focus:ring-yellow-500 sm:text-sm" placeholder="Your name">
              </div>
              
              <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email address</label>
                <input type="email" id="email" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-yellow-500 focus:ring-yellow-500 sm:text-sm" placeholder="you@example.com">
              </div>
              
              <div>
                <label for="subject" class="block text-sm font-medium text-gray-700">Subject</label>
                <input type="text" id="subject" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-yellow-500 focus:ring-yellow-500 sm:text-sm" placeholder="What's your issue about?">
              </div>
              
              <div>
                <label for="message" class="block text-sm font-medium text-gray-700">Message</label>
                <textarea id="message" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-yellow-500 focus:ring-yellow-500 sm:text-sm" placeholder="Tell us how we can help you"></textarea>
              </div>
              
              <div>
                <button type="submit" class="w-full bg-yellow-500 hover:bg-yellow-600 text-white py-3 px-4 rounded-lg font-medium shadow-md transition duration-300 ease-in-out transform hover:-translate-y-0.5">
                  Send Message
                </button>
              </div>
            </div>
          </form>
        </div>
        
        <!-- Contact Info -->
        <div class="p-8 lg:p-12 flex flex-col justify-between">
          <div>
            <h3 class="text-2xl font-bold text-white mb-6">Get in Touch</h3>
            <div class="space-y-6">
              <div class="flex items-start">
                <div class="flex-shrink-0">
                  <div class="bg-yellow-400 bg-opacity-30 rounded-full w-10 h-10 flex items-center justify-center">
                    <i class="fas fa-envelope text-white"></i>
                  </div>
                </div>
                <div class="ml-4">
                  <p class="text-white font-medium">Email us</p>
                  <p class="text-yellow-100">support@helphive.com</p>
                </div>
              </div>
              
              <div class="flex items-start">
                <div class="flex-shrink-0">
                  <div class="bg-yellow-400 bg-opacity-30 rounded-full w-10 h-10 flex items-center justify-center">
                    <i class="fas fa-phone text-white"></i>
                  </div>
                </div>
                <div class="ml-4">
                  <p class="text-white font-medium">Call us</p>
                  <p class="text-yellow-100">+1 (800) 123-4567</p>
                </div>
              </div>
              
              <div class="flex items-start">
                <div class="flex-shrink-0">
                  <div class="bg-yellow-400 bg-opacity-30 rounded-full w-10 h-10 flex items-center justify-center">
                    <i class="fas fa-map-marker-alt text-white"></i>
                  </div>
                </div>
                <div class="ml-4">
                  <p class="text-white font-medium">Visit us</p>
                  <p class="text-yellow-100">123 HelpHive Street<br>San Francisco, CA 94107</p>
                </div>
              </div>
            </div>
          </div>
          
          <div class="mt-12">
            <h3 class="text-xl font-bold text-white mb-4">Working Hours</h3>
            <p class="text-yellow-100">Monday - Friday: 9AM - 5PM PST<br>Saturday - Sunday: Closed</p>
            
            <div class="mt-8">
              <h3 class="text-xl font-bold text-white mb-4">Follow Us</h3>
              <div class="flex space-x-4">
                <a href="#" class="bg-yellow-400 bg-opacity-30 hover:bg-opacity-50 rounded-full w-10 h-10 flex items-center justify-center text-white">
                  <i class="fab fa-twitter"></i>
                </a>
                <a href="#" class="bg-yellow-400 bg-opacity-30 hover:bg-opacity-50 rounded-full w-10 h-10 flex items-center justify-center text-white">
                  <i class="fab fa-facebook-f"></i>
                </a>
                <a href="#" class="bg-yellow-400 bg-opacity-30 hover:bg-opacity-50 rounded-full w-10 h-10 flex items-center justify-center text-white">
                  <i class="fab fa-linkedin-in"></i>
                </a>
                <a href="#" class="bg-yellow-400 bg-opacity-30 hover:bg-opacity-50 rounded-full w-10 h-10 flex items-center justify-center text-white">
                  <i class="fab fa-instagram"></i>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- FAQ Section -->
  <div class="bg-gray-50">
    <div class="max-w-7xl mx-auto py-16 px-4 sm:px-6 lg:px-8">
      <h2 class="text-3xl font-bold text-center text-gray-800 mb-12">Frequently Asked Questions</h2>
      
      <div class="max-w-3xl mx-auto" x-data="{selected:null}">
        <!-- FAQ Item 1 -->
        <div class="mb-4">
          <button
            @click="selected !== 1 ? selected = 1 : selected = null"
            class="flex justify-between items-center w-full bg-white p-5 rounded-lg shadow-md hover:shadow-lg transition-all duration-300 focus:outline-none"
            :class="{'bg-yellow-50': selected == 1}"
          >
            <span class="text-lg font-medium text-gray-800">How do I create a new support ticket?</span>
            <svg :class="{'transform rotate-180': selected == 1}" class="w-5 h-5 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
            </svg>
          </button>
          <div
            x-show="selected == 1"
            x-collapse
            class="bg-white px-6 pb-5 pt-3 rounded-b-lg shadow-md"
          >
            <p class="text-gray-600">To create a new support ticket, log in to your HelpHive account, navigate to the "Tickets" section, and click on the "New Ticket" button. Fill in the required information and click "Submit" to create your ticket.</p>
          </div>
        </div>
        
        <!-- FAQ Item 2 -->
        <div class="mb-4">
          <button
            @click="selected !== 2 ? selected = 2 : selected = null"
            class="flex justify-between items-center w-full bg-white p-5 rounded-lg shadow-md hover:shadow-lg transition-all duration-300 focus:outline-none"
            :class="{'bg-yellow-50': selected == 2}"
          >
            <span class="text-lg font-medium text-gray-800">How can I add team members to my account?</span>
            <svg :class="{'transform rotate-180': selected == 2}" class="w-5 h-5 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
            </svg>
          </button>
          <div
            x-show="selected == 2"
            x-collapse
            class="bg-white px-6 pb-5 pt-3 rounded-b-lg shadow-md"
          >
            <p class="text-gray-600">To add team members, go to "Settings" > "Team Members" and click on "Invite Member." Enter their email address, select their role, and click "Send Invitation." They will receive an email with instructions to join your HelpHive team.</p>
          </div>
        </div>
        
        <!-- FAQ Item 3 -->
        <div class="mb-4">
          <button
            @click="selected !== 3 ? selected = 3 : selected = null"
            class="flex justify-between items-center w-full bg-white p-5 rounded-lg shadow-md hover:shadow-lg transition-all duration-300 focus:outline-none"
            :class="{'bg-yellow-50': selected == 3}"
          >
            <span class="text-lg font-medium text-gray-800">What payment methods do you accept?</span>
            <svg :class="{'transform rotate-180': selected == 3}" class="w-5 h-5 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
            </svg>
          </button>
          <div
            x-show="selected == 3"
            x-collapse
            class="bg-white px-6 pb-5 pt-3 rounded-b-lg shadow-md"
          >
            <p class="text-gray-600">HelpHive accepts all major credit cards (Visa, MasterCard, American Express, and Discover), PayPal, and bank transfers for annual plans. We also offer invoicing options for enterprise customers.</p>
          </div>
        </div>
        
        <!-- FAQ Item 4 -->
        <div class="mb-4">
          <button
            @click="selected !== 4 ? selected = 4 : selected = null"
            class="flex justify-between items-center w-full bg-white p-5 rounded-lg shadow-md hover:shadow-lg transition-all duration-300 focus:outline-none"
            :class="{'bg-yellow-50': selected == 4}"
          >
            <span class="text-lg font-medium text-gray-800">Can I cancel my subscription at any time?</span>
            <svg :class="{'transform rotate-180': selected == 4}" class="w-5 h-5 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
            </svg>
          </button>
          <div
            x-show="selected == 4"
            x-collapse
            class="bg-white px-6 pb-5 pt-3 rounded-b-lg shadow-md"
          >
            <p class="text-gray-600">Yes, you can cancel your subscription at any time. Simply go to "Settings" > "Billing" and click on "Cancel Subscription." Your account will remain active until the end of your current billing period.</p>
          </div>
        </div>
        
        <!-- FAQ Item 5 -->
        <div class="mb-4">
          <button
            @click="selected !== 5 ? selected = 5 : selected = null"
            class="flex justify-between items-center w-full bg-white p-5 rounded-lg shadow-md hover:shadow-lg transition-all duration-300 focus:outline-none"
            :class="{'bg-yellow-50': selected == 5}"
          >
            <span class="text-lg font-medium text-gray-800">Do you offer integrations with other platforms?</span>
            <svg :class="{'transform rotate-180': selected == 5}" class="w-5 h-5 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
            </svg>
          </button>
          <div
            x-show="selected == 5"
            x-collapse
            class="bg-white px-6 pb-5 pt-3 rounded-b-lg shadow-md"
          >
            <p class="text-gray-600">Yes, HelpHive integrates with many popular tools and platforms, including Slack, Microsoft Teams, Salesforce, Zendesk, HubSpot, Jira, Zapier, and more. You can find all available integrations in the "Integrations" section of your account.</p>
          </div>
        </div>
        
        <div class="text-center mt-10">
          <a href="#" class="inline-flex items-center text-yellow-600 hover:text-yellow-700 font-medium">
            View all FAQs <i class="fas fa-arrow-right ml-2"></i>
          </a>
        </div>
      </div>
    </div>
  </div>

  <!-- CTA Section -->
  <div class="bg-yellow-500">
    <div class="max-w-7xl

@endsection