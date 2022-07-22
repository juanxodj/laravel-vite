import { createRouter, createWebHashHistory } from "vue-router";

import NProgress from "nprogress/nprogress.js";

// Main layout variations
import LayoutSimple from "@/scripts/layouts/variations/Simple.vue";
import LayoutLanding from "@/scripts/layouts/variations/Landing.vue";
import LayoutBackend from "@/scripts/layouts/variations/Backend.vue";
import LayoutBackendBoxed from "@/scripts/layouts/variations/BackendBoxed.vue";
import LayoutBackendMegaMenu from "@/scripts/layouts/variations/BackendMegaMenu.vue";

// Frontend: Landing
const Landing = () => import("@/scripts/views/landing/LandingView.vue");

// Backend Boxed: Dashboard
const BackendBoxedDashboard = () => import("@/scripts/views/backend-boxed/DashboardView.vue");
const BackendBoxedSimple1 = () => import("@/scripts/views/backend-boxed/Simple1View.vue");
const BackendBoxedSimple2 = () => import("@/scripts/views/backend-boxed/Simple2View.vue");
const BackendBoxedImage1 = () => import("@/scripts/views/backend-boxed/Image1View.vue");
const BackendBoxedImage2 = () => import("@/scripts/views/backend-boxed/Image2View.vue");
const BackendBoxedSearch = () => import("@/scripts/views/backend-boxed/SearchView.vue");

// Backend: Dashboard
const BackendDashboard = () => import("@/scripts/views/backend/DashboardView.vue");

// Backend: Blog
const BackendBlogClassic = () => import("@/scripts/views/backend/blog/ClassicView.vue");
const BackendBlogList = () => import("@/scripts/views/backend/blog/ListView.vue");
const BackendBlogGrid = () => import("@/scripts/views/backend/blog/GridView.vue");
const BackendBlogStory = () => import("@/scripts/views/backend/blog/StoryView.vue");
const BackendBlogStoryCover = () => import("@/scripts/views/backend/blog/StoryCoverView.vue");

// Backend: e-Learning
const BackendElearningCourses = () => import("@/scripts/views/backend/elearning/CoursesView.vue");
const BackendElearningCourse = () => import("@/scripts/views/backend/elearning/CourseView.vue");
const BackendElearningLesson = () => import("@/scripts/views/backend/elearning/LessonView.vue");

// Backend: Forum
const BackendForumCategories = () => import("@/scripts/views/backend/forum/CategoriesView.vue");
const BackendForumTopics = () => import("@/scripts/views/backend/forum/TopicsView.vue");
const BackendForumDiscussion = () => import("@/scripts/views/backend/forum/DiscussionView.vue");

// Backend: Blocks
const BackendBlocksStyles = () => import("@/scripts/views/backend/blocks/StylesView.vue");
const BackendBlocksOptions = () => import("@/scripts/views/backend/blocks/OptionsView.vue");
const BackendBlocksForms = () => import("@/scripts/views/backend/blocks/FormsView.vue");
const BackendBlocksThemed = () => import("@/scripts/views/backend/blocks/ThemedView.vue");
const BackendBlocksApi = () => import("@/scripts/views/backend/blocks/ApiView.vue");

// Backend: Elements
const BackendElementsGrid = () => import("@/scripts/views/backend/elements/GridView.vue");
const BackendElementsTypography = () => import("@/scripts/views/backend/elements/TypographyView.vue");
const BackendElementsIcons = () => import("@/scripts/views/backend/elements/IconsView.vue");
const BackendElementsButtons = () => import("@/scripts/views/backend/elements/ButtonsView.vue");
const BackendElementsButtonGroups = () => import("@/scripts/views/backend/elements/ButtonGroupsView.vue");
const BackendElementsDropdowns = () => import("@/scripts/views/backend/elements/DropdownsView.vue");
const BackendElementsTabs = () => import("@/scripts/views/backend/elements/TabsView.vue");
const BackendElementsNavigation = () => import("@/scripts/views/backend/elements/NavigationView.vue");
const BackendElementsNavigationHorizontal = () => import("@/scripts/views/backend/elements/NavigationHorizontalView.vue");
const BackendElementsMegaMenu = () => import("@/scripts/views/backend/elements/MegaMenuView.vue");
const BackendElementsProgress = () => import("@/scripts/views/backend/elements/ProgressView.vue");
const BackendElementsAlerts = () => import("@/scripts/views/backend/elements/AlertsView.vue");
const BackendElementsTooltips = () => import("@/scripts/views/backend/elements/TooltipsView.vue");
const BackendElementsPopovers = () => import("@/scripts/views/backend/elements/PopoversView.vue");
const BackendElementsModals = () => import("@/scripts/views/backend/elements/ModalsView.vue");
const BackendElementsImagesOverlay = () => import("@/scripts/views/backend/elements/ImagesOverlayView.vue");
const BackendElementsTimeline = () => import("@/scripts/views/backend/elements/TimelineView.vue");
const BackendElementsRibbons = () => import("@/scripts/views/backend/elements/RibbonsView.vue");
const BackendElementsAnimations = () => import("@/scripts/views/backend/elements/AnimationsView.vue");
const BackendElementsColorThemes = () => import("@/scripts/views/backend/elements/ColorThemesView.vue");

// Backend: Tables
const BackendTablesStyles = () => import("@/scripts/views/backend/tables/StylesView.vue");
const BackendTablesResponsive = () => import("@/scripts/views/backend/tables/ResponsiveView.vue");
const BackendTablesHelpers = () => import("@/scripts/views/backend/tables/HelpersView.vue");

// Backend: Forms
const BackendFormsElements = () => import("@/scripts/views/backend/forms/ElementsView.vue");
const BackendFormsLayouts = () => import("@/scripts/views/backend/forms/LayoutsView.vue");
const BackendFormsInputGroups = () => import("@/scripts/views/backend/forms/InputGroupsView.vue");
const BackendFormsPlugins = () => import("@/scripts/views/backend/forms/PluginsView.vue");
const BackendFormsEditors = () => import("@/scripts/views/backend/forms/EditorsView.vue");
const BackendFormsValidation = () => import("@/scripts/views/backend/forms/ValidationView.vue");

// Backend: Plugins
const BackendPluginsImageCropper = () => import("@/scripts/views/backend/plugins/ImageCropperView.vue");
const BackendPluginsCharts = () => import("@/scripts/views/backend/plugins/ChartsView.vue");
const BackendPluginsCalendar = () => import("@/scripts/views/backend/plugins/CalendarView.vue");
const BackendPluginsCarousel = () => import("@/scripts/views/backend/plugins/CarouselView.vue");
const BackendPluginsSyntaxHighlighting = () => import("@/scripts/views/backend/plugins/SyntaxHighlightingView.vue");
const BackendPluginsRating = () => import("@/scripts/views/backend/plugins/RatingView.vue");
const BackendPluginsDialogs = () => import("@/scripts/views/backend/plugins/DialogsView.vue");
const BackendPluginsNotifications = () => import("@/scripts/views/backend/plugins/NotificationsView.vue");
const BackendPluginsGallery = () => import("@/scripts/views/backend/plugins/GalleryView.vue");

// Backend: Layout
const BackendLayoutPageDefault = () => import("@/scripts/views/backend/layout/page/DefaultView.vue");
const BackendLayoutPageFlipped = () => import("@/scripts/views/backend/layout/page/FlippedView.vue");
const BackendLayoutDarkModeOn = () => import("@/scripts/views/backend/layout/dark-mode/OnView.vue");
const BackendLayoutDarkModeOff = () => import("@/scripts/views/backend/layout/dark-mode/OffView.vue");
const BackendLayoutDarkModeSystem = () => import("@/scripts/views/backend/layout/dark-mode/SystemView.vue");
const BackendLayoutMainContentFullWidth = () => import("@/scripts/views/backend/layout/main-content/FullWidthView.vue");
const BackendLayoutMainContentNarrow = () => import("@/scripts/views/backend/layout/main-content/NarrowView.vue");
const BackendLayoutMainContentBoxed = () => import("@/scripts/views/backend/layout/main-content/BoxedView.vue");
const BackendLayoutHeaderFixedLight = () => import("@/scripts/views/backend/layout/header/FixedLightView.vue");
const BackendLayoutHeaderFixedDark = () => import("@/scripts/views/backend/layout/header/FixedDarkView.vue");
const BackendLayoutHeaderStaticLight = () => import("@/scripts/views/backend/layout/header/StaticLightView.vue");
const BackendLayoutHeaderStaticDark = () => import("@/scripts/views/backend/layout/header/StaticDarkView.vue");
const BackendLayoutSidebarMini = () => import("@/scripts/views/backend/layout/sidebar/MiniView.vue");
const BackendLayoutSidebarLight = () => import("@/scripts/views/backend/layout/sidebar/LightView.vue");
const BackendLayoutSidebarDark = () => import("@/scripts/views/backend/layout/sidebar/DarkView.vue");
const BackendLayoutSidebarHidden = () => import("@/scripts/views/backend/layout/sidebar/HiddenView.vue");
const BackendLayoutSideOverlayVisible = () => import("@/scripts/views/backend/layout/side-overlay/VisibleView.vue");
const BackendLayoutSideOverlayHoverMode = () => import("@/scripts/views/backend/layout/side-overlay/HoverModeView.vue");
const BackendLayoutSideOverlayNoPageOverlay = () => import("@/scripts/views/backend/layout/side-overlay/NoPageOverlayView.vue");
const BackendLayoutLoaders = () => import("@/scripts/views/backend/layout/LoadersView.vue");
const BackendLayoutApi = () => import("@/scripts/views/backend/layout/ApiView.vue");

// Backend: Generic Pages
const BackendPagesGenericBlank = () => import("@/scripts/views/backend/pages/generic/BlankView.vue");
const BackendPagesGenericBlankBlock = () => import("@/scripts/views/backend/pages/generic/BlankBlockView.vue");
const BackendPagesGenericSearch = () => import("@/scripts/views/backend/pages/generic/SearchView.vue");
const BackendPagesGenericProfile = () => import("@/scripts/views/backend/pages/generic/ProfileView.vue");
const BackendPagesGenericInvoice = () => import("@/scripts/views/backend/pages/generic/InvoiceView.vue");
const BackendPagesGenericPricingPlans = () => import("@/scripts/views/backend/pages/generic/PricingPlansView.vue");
const BackendPagesGenericFaq = () => import("@/scripts/views/backend/pages/generic/FaqView.vue");
const BackendPagesGenericInbox = () => import("@/scripts/views/backend/pages/generic/InboxView.vue");

// Backend: Pages
const BackendPagesAuth = () => import("@/scripts/views/backend/pages/AuthView.vue");
const BackendPagesErrors = () => import("@/scripts/views/backend/pages/ErrorsView.vue");

// Specials
const SpecialsMaintenance = () => import("@/scripts/views/specials/MaintenanceView.vue");
const SpecialsStatus = () => import("@/scripts/views/specials/StatusView.vue");
const SpecialsComingSoon = () => import("@/scripts/views/specials/ComingSoonView.vue");

// Auth
const AuthSignIn = () => import("@/scripts/views/auth/SignInView.vue");
const AuthSignIn2 = () => import("@/scripts/views/auth/SignIn2View.vue");
const AuthSignIn3 = () => import("@/scripts/views/auth/SignIn3View.vue");
const AuthSignUp = () => import("@/scripts/views/auth/SignUpView.vue");
const AuthSignUp2 = () => import("@/scripts/views/auth/SignUp2View.vue");
const AuthSignUp3 = () => import("@/scripts/views/auth/SignUp3View.vue");
const AuthLock = () => import("@/scripts/views/auth/LockView.vue");
const AuthLock2 = () => import("@/scripts/views/auth/Lock2View.vue");
const AuthLock3 = () => import("@/scripts/views/auth/Lock3View.vue");
const AuthReminder = () => import("@/scripts/views/auth/ReminderView.vue");
const AuthReminder2 = () => import("@/scripts/views/auth/Reminder2View.vue");
const AuthReminder3 = () => import("@/scripts/views/auth/Reminder3View.vue");

// Errors
const Error400 = () => import("@/scripts/views/errors/400View.vue");
const Error401 = () => import("@/scripts/views/errors/401View.vue");
const Error403 = () => import("@/scripts/views/errors/403View.vue");
const Error404 = () => import("@/scripts/views/errors/404View.vue");
const Error500 = () => import("@/scripts/views/errors/500View.vue");
const Error503 = () => import("@/scripts/views/errors/503View.vue");

// Set all routes
const routes = [
  /*
  |
  |--------------------------------------------------------------------------
  | Landing Routes
  |--------------------------------------------------------------------------
  |
  */
  {
    path: "/",
    component: LayoutLanding,
    children: [
      {
        path: "",
        name: "landing",
        component: Landing,
      },
    ],
  },

  /*
  |
  |--------------------------------------------------------------------------
  | Backend Boxed Routes
  |--------------------------------------------------------------------------
  |
  */
  {
    path: "/backend-boxed",
    component: LayoutBackendBoxed,
    children: [
      {
        path: "",
        name: "backend-boxed-dashboard",
        component: BackendBoxedDashboard,
      },
      {
        path: "simple1",
        name: "backend-boxed-simple1",
        component: BackendBoxedSimple1,
      },
      {
        path: "simple2",
        name: "backend-boxed-simple2",
        component: BackendBoxedSimple2,
      },
      {
        path: "image1",
        name: "backend-boxed-image1",
        component: BackendBoxedImage1,
      },
      {
        path: "image2",
        name: "backend-boxed-image2",
        component: BackendBoxedImage2,
      },
      {
        path: "search",
        name: "backend-boxed-search",
        component: BackendBoxedSearch,
      },
    ],
  },

  /*
  |--------------------------------------------------------------------------
  | Backend Mega Menu Route
  |--------------------------------------------------------------------------
  */

  {
    path: "/backend/elements",
    component: LayoutBackendMegaMenu,
    children: [
      {
        path: "mega-menu",
        name: "backend-elements-mega-menu",
        component: BackendElementsMegaMenu,
      },
    ],
  },

  /*
  |
  |--------------------------------------------------------------------------
  | Backend Routes
  |--------------------------------------------------------------------------
  |
  */
  {
    path: "/backend",
    redirect: "/backend/dashboard",
    component: LayoutBackend,
    children: [
      {
        path: "dashboard",
        name: "backend-dashboard",
        component: BackendDashboard,
      },

      /*
      |--------------------------------------------------------------------------
      | Backend Blog Routes
      |--------------------------------------------------------------------------
      */
      {
        path: "page-packs/blog",
        redirect: "/page-packs/blog/classic",
        children: [
          {
            path: "classic",
            name: "backend-blog-classic",
            component: BackendBlogClassic,
          },
          {
            path: "list",
            name: "backend-blog-list",
            component: BackendBlogList,
          },
          {
            path: "grid",
            name: "backend-blog-grid",
            component: BackendBlogGrid,
          },
          {
            path: "story",
            name: "backend-blog-story",
            component: BackendBlogStory,
          },
          {
            path: "story-cover",
            name: "backend-blog-story-cover",
            component: BackendBlogStoryCover,
          },
        ],
      },

      /*
      |--------------------------------------------------------------------------
      | Backend e-Learning Routes
      |--------------------------------------------------------------------------
      */
      {
        path: "page-packs/elearning",
        redirect: "/page-packs/elearning/courses",
        children: [
          {
            path: "courses",
            name: "backend-elearning-courses",
            component: BackendElearningCourses,
          },
          {
            path: "course",
            name: "backend-elearning-course",
            component: BackendElearningCourse,
          },
          {
            path: "lesson",
            name: "backend-elearning-lesson",
            component: BackendElearningLesson,
          },
        ],
      },

      /*
      |--------------------------------------------------------------------------
      | Backend Forum Routes
      |--------------------------------------------------------------------------
      */
      {
        path: "page-packs/forum",
        redirect: "/page-packs/forum/categories",
        children: [
          {
            path: "categories",
            name: "backend-forum-categories",
            component: BackendForumCategories,
          },
          {
            path: "topics",
            name: "backend-forum-topics",
            component: BackendForumTopics,
          },
          {
            path: "discussion",
            name: "backend-forum-discussion",
            component: BackendForumDiscussion,
          },
        ],
      },

      /*
      |--------------------------------------------------------------------------
      | Backend Blocks Routes
      |--------------------------------------------------------------------------
      */
      {
        path: "blocks",
        redirect: "/blocks/styles",
        children: [
          {
            path: "styles",
            name: "backend-blocks-styles",
            component: BackendBlocksStyles,
          },
          {
            path: "options",
            name: "backend-blocks-options",
            component: BackendBlocksOptions,
          },
          {
            path: "forms",
            name: "backend-blocks-forms",
            component: BackendBlocksForms,
          },
          {
            path: "themed",
            name: "backend-blocks-themed",
            component: BackendBlocksThemed,
          },
          {
            path: "api",
            name: "backend-blocks-api",
            component: BackendBlocksApi,
          },
        ],
      },

      /*
      |--------------------------------------------------------------------------
      | Backend Elements Routes
      |--------------------------------------------------------------------------
      */
      {
        path: "elements",
        redirect: "/elements/grid",
        children: [
          {
            path: "grid",
            name: "backend-elements-grid",
            component: BackendElementsGrid,
          },
          {
            path: "typography",
            name: "backend-elements-typography",
            component: BackendElementsTypography,
          },
          {
            path: "icons",
            name: "backend-elements-icons",
            component: BackendElementsIcons,
          },
          {
            path: "buttons",
            name: "backend-elements-buttons",
            component: BackendElementsButtons,
          },
          {
            path: "button-groups",
            name: "backend-elements-button-groups",
            component: BackendElementsButtonGroups,
          },
          {
            path: "dropdowns",
            name: "backend-elements-dropdowns",
            component: BackendElementsDropdowns,
          },
          {
            path: "tabs",
            name: "backend-elements-tabs",
            component: BackendElementsTabs,
          },
          {
            path: "navigation",
            name: "backend-elements-navigation",
            component: BackendElementsNavigation,
          },
          {
            path: "navigation-horizontal",
            name: "backend-elements-navigation-horizontal",
            component: BackendElementsNavigationHorizontal,
          },
          {
            path: "progress",
            name: "backend-elements-progress",
            component: BackendElementsProgress,
          },
          {
            path: "alerts",
            name: "backend-elements-alerts",
            component: BackendElementsAlerts,
          },
          {
            path: "tooltips",
            name: "backend-elements-tooltips",
            component: BackendElementsTooltips,
          },
          {
            path: "popovers",
            name: "backend-elements-popovers",
            component: BackendElementsPopovers,
          },
          {
            path: "modals",
            name: "backend-elements-modals",
            component: BackendElementsModals,
          },
          {
            path: "images-overlay",
            name: "backend-elements-images-overlay",
            component: BackendElementsImagesOverlay,
          },
          {
            path: "timeline",
            name: "backend-elements-timeline",
            component: BackendElementsTimeline,
          },
          {
            path: "ribbons",
            name: "backend-elements-ribbons",
            component: BackendElementsRibbons,
          },
          {
            path: "animations",
            name: "backend-elements-animations",
            component: BackendElementsAnimations,
          },
          {
            path: "color-themes",
            name: "backend-elements-color-themes",
            component: BackendElementsColorThemes,
          },
        ],
      },

      /*
      |--------------------------------------------------------------------------
      | Backend Plugins Routes
      |--------------------------------------------------------------------------
      */
      {
        path: "tables",
        redirect: "/tables/styles",
        children: [
          {
            path: "styles",
            name: "backend-tables-styles",
            component: BackendTablesStyles,
          },
          {
            path: "responsive",
            name: "backend-tables-responsive",
            component: BackendTablesResponsive,
          },
          {
            path: "helpers",
            name: "backend-tables-helpers",
            component: BackendTablesHelpers,
          },
        ],
      },

      /*
      |--------------------------------------------------------------------------
      | Backend Forms Routes
      |--------------------------------------------------------------------------
      */
      {
        path: "forms",
        redirect: "/forms/elements",
        children: [
          {
            path: "elements",
            name: "backend-form-elements",
            component: BackendFormsElements,
          },
          {
            path: "layouts",
            name: "backend-form-layouts",
            component: BackendFormsLayouts,
          },
          {
            path: "input-groups",
            name: "backend-form-input-groups",
            component: BackendFormsInputGroups,
          },
          {
            path: "plugins",
            name: "backend-form-plugins",
            component: BackendFormsPlugins,
          },
          {
            path: "editors",
            name: "backend-form-editors",
            component: BackendFormsEditors,
          },
          {
            path: "validation",
            name: "backend-form-validation",
            component: BackendFormsValidation,
          },
        ],
      },

      /*
      |--------------------------------------------------------------------------
      | Backend Plugins Routes
      |--------------------------------------------------------------------------
      */
      {
        path: "plugins",
        redirect: "/plugins/image-cropper",
        children: [
          {
            path: "image-cropper",
            name: "backend-plugins-image-cropper",
            component: BackendPluginsImageCropper,
          },
          {
            path: "charts",
            name: "backend-plugins-charts",
            component: BackendPluginsCharts,
          },
          {
            path: "calendar",
            name: "backend-plugins-calendar",
            component: BackendPluginsCalendar,
          },
          {
            path: "carousel",
            name: "backend-plugins-carousel",
            component: BackendPluginsCarousel,
          },
          {
            path: "syntax-highlighting",
            name: "backend-plugins-syntax-highlighting",
            component: BackendPluginsSyntaxHighlighting,
          },
          {
            path: "rating",
            name: "backend-plugins-rating",
            component: BackendPluginsRating,
          },
          {
            path: "dialogs",
            name: "backend-plugins-dialogs",
            component: BackendPluginsDialogs,
          },
          {
            path: "notifications",
            name: "backend-plugins-notifications",
            component: BackendPluginsNotifications,
          },
          {
            path: "gallery",
            name: "backend-plugins-gallery",
            component: BackendPluginsGallery,
          },
        ],
      },

      /*
      |--------------------------------------------------------------------------
      | Backend Layout Routes
      |--------------------------------------------------------------------------
      */
      {
        path: "layout",
        redirect: "/layout/api",
        children: [
          {
            path: "page/default",
            name: "backend-layout-page-default",
            component: BackendLayoutPageDefault,
          },
          {
            path: "page/flipped",
            name: "backend-layout-page-flipped",
            component: BackendLayoutPageFlipped,
          },
          {
            path: "dark-mode/on",
            name: "backend-layout-dark-mode-on",
            component: BackendLayoutDarkModeOn,
          },
          {
            path: "dark-mode/off",
            name: "backend-layout-dark-mode-off",
            component: BackendLayoutDarkModeOff,
          },
          {
            path: "dark-mode/system",
            name: "backend-layout-dark-mode-system",
            component: BackendLayoutDarkModeSystem,
          },
          {
            path: "main-content/full-width",
            name: "backend-layout-main-content-full-width",
            component: BackendLayoutMainContentFullWidth,
          },
          {
            path: "main-content/narrow",
            name: "backend-layout-main-content-narrow",
            component: BackendLayoutMainContentNarrow,
          },
          {
            path: "main-content/boxed",
            name: "backend-layout-main-content-boxed",
            component: BackendLayoutMainContentBoxed,
          },
          {
            path: "header/fixed-light",
            name: "backend-layout-header-fixed-light",
            component: BackendLayoutHeaderFixedLight,
          },
          {
            path: "header/fixed-dark",
            name: "backend-layout-header-fixed-dark",
            component: BackendLayoutHeaderFixedDark,
          },
          {
            path: "header/static-light",
            name: "backend-layout-header-static-light",
            component: BackendLayoutHeaderStaticLight,
          },
          {
            path: "header/static-dark",
            name: "backend-layout-header-static-dark",
            component: BackendLayoutHeaderStaticDark,
          },
          {
            path: "sidebar/mini",
            name: "backend-layout-sidebar-mini",
            component: BackendLayoutSidebarMini,
          },
          {
            path: "sidebar/light",
            name: "backend-layout-sidebar-light",
            component: BackendLayoutSidebarLight,
          },
          {
            path: "sidebar/dark",
            name: "backend-layout-sidebar-dark",
            component: BackendLayoutSidebarDark,
          },
          {
            path: "sidebar/hidden",
            name: "backend-layout-sidebar-hidden",
            component: BackendLayoutSidebarHidden,
          },
          {
            path: "side-overlay/visible",
            name: "backend-layout-side-overlay-visible",
            component: BackendLayoutSideOverlayVisible,
          },
          {
            path: "side-overlay/hover-mode",
            name: "backend-layout-side-overlay-hover-mode",
            component: BackendLayoutSideOverlayHoverMode,
          },
          {
            path: "side-overlay/no-page-overlay",
            name: "backend-layout-side-overlay-no-page-overlay",
            component: BackendLayoutSideOverlayNoPageOverlay,
          },
          {
            path: "loaders",
            name: "backend-layout-loaders",
            component: BackendLayoutLoaders,
          },
          {
            path: "api",
            name: "backend-layout-api",
            component: BackendLayoutApi,
          },
        ],
      },

      /*
      |--------------------------------------------------------------------------
      | Backend Generic Pages Routes
      |--------------------------------------------------------------------------
      */
      {
        path: "pages/generic",
        redirect: "/pages/generic/blank",
        children: [
          {
            path: "blank",
            name: "backend-pages-generic-blank",
            component: BackendPagesGenericBlank,
          },
          {
            path: "blank-block",
            name: "backend-pages-generic-blank-block",
            component: BackendPagesGenericBlankBlock,
          },
          {
            path: "search",
            name: "backend-pages-generic-search",
            component: BackendPagesGenericSearch,
          },
          {
            path: "profile",
            name: "backend-pages-generic-profile",
            component: BackendPagesGenericProfile,
          },
          {
            path: "invoice",
            name: "backend-pages-generic-invoice",
            component: BackendPagesGenericInvoice,
          },
          {
            path: "pricing-plans",
            name: "backend-pages-generic-pricing-plans",
            component: BackendPagesGenericPricingPlans,
          },
          {
            path: "faq",
            name: "backend-pages-generic-faq",
            component: BackendPagesGenericFaq,
          },
          {
            path: "inbox",
            name: "backend-pages-generic-inbox",
            component: BackendPagesGenericInbox,
          },
        ],
      },

      /*
      |--------------------------------------------------------------------------
      | Backend Pages Routes
      |--------------------------------------------------------------------------
      */
      {
        path: "pages",
        children: [
          {
            path: "auth",
            name: "backend-pages-auth",
            component: BackendPagesAuth,
          },
          {
            path: "errors",
            name: "backend-pages-errors",
            component: BackendPagesErrors,
          },
        ],
      },
    ],
  },

  /*
  |
  |--------------------------------------------------------------------------
  | Special Routes
  |--------------------------------------------------------------------------
  |
  */
  {
    path: "/specials",
    component: LayoutSimple,
    children: [
      {
        path: "maintenance",
        name: "specials-maintenance",
        component: SpecialsMaintenance,
      },
      {
        path: "status",
        name: "specials-status",
        component: SpecialsStatus,
      },
      {
        path: "coming-soon",
        name: "specials-coming-soon",
        component: SpecialsComingSoon,
      },
    ],
  },

  /*
  |
  |--------------------------------------------------------------------------
  | Auth Routes
  |--------------------------------------------------------------------------
  |
  */
  {
    path: "/auth",
    component: LayoutSimple,
    children: [
      {
        path: "signin",
        name: "auth-signin",
        component: AuthSignIn,
      },
      {
        path: "signin2",
        name: "auth-signin2",
        component: AuthSignIn2,
      },
      {
        path: "signin3",
        name: "auth-signin3",
        component: AuthSignIn3,
      },
      {
        path: "signup",
        name: "auth-signup",
        component: AuthSignUp,
      },
      {
        path: "signup2",
        name: "auth-signup2",
        component: AuthSignUp2,
      },
      {
        path: "signup3",
        name: "auth-signup3",
        component: AuthSignUp3,
      },
      {
        path: "lock",
        name: "auth-lock",
        component: AuthLock,
      },
      {
        path: "lock2",
        name: "auth-lock2",
        component: AuthLock2,
      },
      {
        path: "lock3",
        name: "auth-lock3",
        component: AuthLock3,
      },
      {
        path: "reminder",
        name: "auth-reminder",
        component: AuthReminder,
      },
      {
        path: "reminder2",
        name: "auth-reminder2",
        component: AuthReminder2,
      },
      {
        path: "reminder3",
        name: "auth-reminder3",
        component: AuthReminder3,
      },
    ],
  },

  /*
  |
  |--------------------------------------------------------------------------
  | Error Routes
  |--------------------------------------------------------------------------
  |
  */
  {
    path: "/errors",
    component: LayoutSimple,
    children: [
      {
        path: "400",
        name: "error-400",
        component: Error400,
      },
      {
        path: "401",
        name: "error-401",
        component: Error401,
      },
      {
        path: "403",
        name: "error-403",
        component: Error403,
      },
      {
        path: "404",
        name: "error-404",
        component: Error404,
      },
      {
        path: "500",
        name: "error-500",
        component: Error500,
      },
      {
        path: "503",
        name: "error-503",
        component: Error503,
      },
    ],
  },
];

// Create Router
const router = createRouter({
  history: createWebHashHistory(),
  linkActiveClass: "active",
  linkExactActiveClass: "",
  scrollBehavior() {
    return { left: 0, top: 0 };
  },
  routes,
});

// NProgress
/*eslint-disable no-unused-vars*/
NProgress.configure({ showSpinner: false });

router.beforeResolve((to, from, next) => {
  if (to.name) {
    NProgress.start();
  }

  next();
});

router.afterEach(() => {
  NProgress.done();
});
/*eslint-enable no-unused-vars*/

export default router;
